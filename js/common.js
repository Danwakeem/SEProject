var orderItems = [];
var orderTotal = 0;
var itemCount = 0;
var editingMenu = false;

var commentItemPos;

//Statuses for managers and waiters
var statusMessages = {
	Ready: 
	{ msg:" Table is ready for customer",
	  class:"alert alert-info table-info", 
	  dropDownButtonClass: "btn btn-primary dropdown-toggle", 
	  dropDownMenuClass: "dropdown-menu status-dropdown-menu ",
	  dropDownButtonText: ' Ready <span class="caret"></span>',
	  BillOpen: false
	},
	NeedAssistance:
	{ msg:' This table <a class="alert-link" href="#">requires assistance</a> ',
	  class:'alert alert-danger table-info',
	  dropDownButtonClass: "btn btn-danger dropdown-toggle", 
	  dropDownMenuClass: "dropdown-menu status-dropdown-menu dropdown-red",
	  dropDownButtonText: ' NeedAssistance <span class="caret"></span>',
	  BillOpen: true
	},
	WaitingForOrder:
	{ msg:' Waiting for table to order ',
	  class:'alert alert-info table-info',
	  dropDownButtonClass: "btn btn-primary dropdown-toggle", 
	  dropDownMenuClass: "dropdown-menu status-dropdown-menu ",
	  dropDownButtonText: ' CreatingOrder <span class="caret"></span>',
	  BillOpen: true
	},
	WaitingForFood:
	{ msg:' Waiting for food ',
	  class:'alert alert-info table-info',
	  dropDownButtonClass: "btn btn-primary dropdown-toggle", 
	  dropDownMenuClass: "dropdown-menu status-dropdown-menu ",
	  dropDownButtonText: ' WaitingForFood <span class="caret"></span>',
	  BillOpen: true
	},
	OrderReady:
	{ msg:' Food is ready ',
	  class:'alert alert-success table-info',
	  dropDownButtonClass: "btn btn-success dropdown-toggle", 
	  dropDownMenuClass: "dropdown-menu status-dropdown-menu dropdown-green",
	  dropDownButtonText: ' Order Ready <span class="caret"></span>',
	  BillOpen: true
	},
	FoodDelivered:
	{ msg:' Waiting For payment ',
	  class:'alert alert-info table-info',
	  dropDownButtonClass: "btn btn-primary dropdown-toggle", 
	  dropDownMenuClass: "dropdown-menu status-dropdown-menu ",
	  dropDownButtonText: ' FoodDelivered <span class="caret"></span>',
	  BillOpen: true
	},
	Paid:
	{ msg:' Paid and <span class="alert-link">needs to be cleared.</span>',
	  class:'alert alert-warning table-info',
	  dropDownButtonClass: "btn btn-warning dropdown-toggle", 
	  dropDownMenuClass: "dropdown-menu status-dropdown-menu dropdown-yellow",
	  dropDownButtonText: ' Paid <span class="caret"></span>',
	  BillOpen: false
	}
}

//Customer order cart stuff
var newOrderItem  = '<li id="dish'; //Dish with ID
var newOrderItem2 = '"><div class="row" style="margin-top:10px;"><div class="col-xs-5"><a class="dropdown-col-lt">'; //Add Name 
var newOrderItem3 = '</a></div><div class="col-xs-2"><a id="quantity" class="dropdown-col-rt edit">'; //Quantity goes here
var newOrderItem33 = '</a></div><div class="col-xs-2"><input type="text" data="quantity" class="form-control qty-input" maxlength="2" value="'; //Quantity goes here
var newOrderItem44 = '" onchange="updateQuantity(this)" ></div><div class="col-xs-2 dropdown-col-rt"><a id="price" class="dropdown-col-rt">'; //Add Price 
var newOrderItem4 = '</a></div><div class="col-xs-2 dropdown-col-rt"><a id="price" class="dropdown-col-rt">'; //Add Price 
var newOrderItem5 = '</a></div><div class="col-xs-1"></div></div></li>';
var newOrderItem55 = '</a></div><div class="col-xs-1 dropdown-col-rt"><a class="dropdown-col-rt" data-toggle="modal" data-target="#commentModal" onclick="commentObject(this)"><i class="fa fa-comment-o" title="Comments" rel="tooltip" title="Comments" ></i></a></div></div></li>'; 

//New orders for chef
var newChefItem  = '<tr class="orderRow'; //OrderId
var newChefItem2 = '"><td><div class="checkbox"><label><input class="'; //OrderId
var newChefItem3 = '" onclick="checkOrderRadios(this)" type="checkbox" value=""></label></div></td><td>'; //Quantity
var newChefItem4 = '</td><td>'; //Title
var newChefItem5 = '</td><td>'; //notes
var newChefItem6 = '</td><td id="tableId" data="'; //TableId
var newChefItem7 = '">'; //userName
var newChefItem8 = '</td></tr>';

/*
 * Sad attempt at getting a tool tip to work
 */
$(document).ready(function(){
	$("[rel='tooltip']").tooltip();
});

/*
 * PUBNUB
 */

 /**
  * PubNub initialization
  */
var pubnub = PUBNUB.init({
    publish_key: 'pub-c-31dd9891-4fe2-4e6b-b7c7-412e1ec6bc30',
    subscribe_key: 'sub-c-67f9f974-e10d-11e5-b605-02ee2ddab7fe',
    error: function (error) {
        console.log('Error:', error);
    }
});

/**
 * WebSocket Subscribe to waiter updates
 */
function subscribeToWaiterUpdates(){
	pubnub.subscribe({
		channel: 'waiterUpdate',
		message: function(e){
			if(e.tableId === tableId){
				$('#callButton').show();
				$('#waiterWait').remove();
				logoutCustomer();
			}
		},
		error: function(error){
			console.log(JSON.stringify(error));
		}
	});
}

function subscribeToMenuUpdates(){
	pubnub.subscribe({
		channel: 'menuUpdate',
		message: function(e){
			if(e == "fetch"){
				returnToMenu();
			} else {
				$( "#menu" ).replaceWith(e);
			}
		},
		error: function(error){
			console.log(JSON.stringify(error));
		}
	});	
}

/**
 * WebSocket subscribe to order updates
 */
function subscribeToOrderUpdates(){
	pubnub.subscribe({
		channel: 'orderUpdate',
		message: function(e){
			changeTableStatus(e['tableId'],e['status'],false);
		},
		error: function(error){
			console.log(JSON.stringify(error));
		}
	});
}

/**
 * WebSocket subscribe to table updates
 */
function subscribeToTableUpdates(){
	pubnub.subscribe({
		channel: 'tableUpdate',
		message: function(e){
			if(userType === 'waiter') {
				updateTableList();
				//changeTableStatus(e['tableId'],e['status'],false);
			} else if (userType === 'chef' && e['status'] === 'WaitingForFood') {
				updateOrderList();
				//addOrderItems(e['orderId'],e['order'],e['tableName'],e['tableId']);
			}
		},
		error: function(error){
			console.log(JSON.stringify(error));
		}
	});
}

/* End PubNub */

/*
 * Manager interactions
 */

 function checkBoxChange(el) {
 	var id = $(el).attr('data');
    if(el.checked) {
    	menuEditorItems[id] = 1;
    } else {
    	menuEditorItems[id] = 0;
    }
    var keys = Object.keys(menuEditorItems);
    console.log(keys.length);
}

function publishMenuUpdate(){
	pubnub.publish({
		channel: 'menuUpdate',
		message: "fetch",
		callback:function(e){console.log(e);}
	})
}

function saveMenuItemChanges(){
	var keys = Object.keys(menuEditorItems);
	console.log(menuEditorItems);
	if(keys.length > 0){
		var data = {userAction:'updateMenuItems',menuItems:menuEditorItems};
		$.ajax({
		  url: "ajax.php",
		  type: "POST",
		  data: data,
		  success: function(e){
		  	console.log(e);
		  	if(e){
		  		//Show message
		  		$('#success-menu-edit').fadeToggle(2000,function(){
		  			$(this).fadeToggle(2000);
		  		}).delay(1000);

		  		pubnub.publish({
		  			channel: 'menuUpdate',
		  			message: e,
		  			callback:function(e){console.log(e);}
		  		})	
		  	} else {
		  		//Warning flag
		  		$('#danger-menu-edit').fadeToggle(2000,function(){
		  			$(this).fadeToggle(2000);
		  		}).delay(1000);
		  	}
		  },
		  error: function(jqXHR, textStatus, errorThrown) {
 			console.log(textStatus, errorThrown);
		  }
		});
	}
}

/*
 * Waiter interactions
 */

/*
 * Absraction for changing the status of a customer that has paid
 * @param data This is the data passed back from the pubnub notification
 */
 var customerPaidFunction = function(data) {
 	if(userType === 'waiter') {
 		changeTableStatus(data['tableId'], data['status'], false);

 	}
 }

/**
 * Abstraction for changin the status of a table.
 * @param id is the table id
 * @param status is the new status of the table
 * @param updateDB is a bool to determine if db needs update 
 */
function changeTableStatus(id,status,updateDB) {
	if(updateDB){
		var updateInfo = statusMessages[status];
		var data = {userAction:'updateTableStatus',status:status,tableId:id};
		updateDBTableStatus(updateInfo,data,id);
	} else {
		var updateInfo = statusMessages[status];
		updateTableUI(updateInfo,id);
	}
}

function updateTableList(){
	var data = {userAction: 'getTableList'};
	$.ajax({
		  url: "ajax.php",
		  type: "POST",
		  data: data,
		  success: function(e){
		  	$('#tableList').replaceWith(e);
		  },
		  error: function(jqXHR, textStatus, errorThrown) {
 			console.log(textStatus, errorThrown);
		  }
	});
}

/**
 * This is the ajax call that updates the database with a new customer status
 * @param updateInfo is the new info to be displayed on the screen
 * @param data is the data to be used in the request
 * @param id is the id of the table
 */
function updateDBTableStatus(updateInfo,data,id){
	$.ajax({
		  url: "ajax.php",
		  type: "POST",
		  data: data,
		  success: function(e){
		  	console.log(e);
		  	if(e){
		  		updateTableUI(updateInfo,id);
		  		var pubData = {tableId: id};
		  		pubnub.publish({
					channel: 'waiterUpdate',
					message: pubData,
					callback : function(m){console.log(m)}
				});
		  	} else {
		  		//Warning flag
		  	}
		  },
		  error: function(jqXHR, textStatus, errorThrown) {
 			console.log(textStatus, errorThrown);
		  }
	});
}

/**
 * This function updates the view for the table whos status was updated
 * @param updateInfo is the new info to display
 * @param id is the tableId
 */
function updateTableUI(updateInfo,id){
	console.log("updating UI");
	$('#msg' + id).html(updateInfo.msg);
	$('#table' + id).removeClass().addClass(updateInfo.class);
	$('#statusButton' + id).removeClass().addClass(updateInfo.dropDownButtonClass).html(updateInfo.dropDownButtonText);
	$('#dropDownMenu' + id).removeClass().addClass(updateInfo.dropDownMenuClass);

	if(updateInfo.BillOpen){
		if($('#viewBillLink').length){
		} else {
			var html = '<p id="viewBillLink" class="vertical-center middle-align"><a href="payBillPage.php?waiterEdit&tableId=' + id + '">View Bill ></a></p>';
			$('#viewBillCol').append(html);
		}
	} else {
		if($('#viewBillLink').length){
			$('#viewBillLink').remove();
		}
	}
}

/**
 * This is supposed to reset a table in an early implementation
 * @param id is the id of the table
 * @param username is the username of the table
 * @depricated
 */
function resetTable(id,username){
	var section = "#table" + id;
	var findByID = $(section);
	findByID.removeClass();
	findByID.addClass('alert alert-info');
	findByID.empty();
	findByID.html('<p><strong>'+ username +'</strong> Waiting for table to order <a href="#" style="float:right;">View bill &gt;</a></p>');
}

/* End Waiter */

/*
 * Chef interactions
 */

/**
 * This function is an absctracted function to check all of the radio buttons for an entier order
 * @param element The element is used to get the the class for each item in an order
 */
function checkOrderRadios(element) {
	var classId = $(element).attr('class');
	if($('.' +classId+':checked').length === $('.'+classId).length){
		updateOrderStatus(classId,'ReadyForDelivery',updateMealList);
	}
}

/**
 * This function updates the meal list by removing an order from the list
 * @param id The id is the order id
 */
var updateMealList = function(id) {
	var collectionOfOrders = $('.orderRow' + id).find('#tableId');
	var rowOfOrder = collectionOfOrders[0];
	var tableId = $(rowOfOrder).attr('data');
	var data = {tableId: tableId, status: 'OrderReady'};

	$('.'+id).parent().parent().parent().parent().fadeOut('slow');

	pubnub.publish({
		channel: 'orderUpdate',        
		message: data,
		callback : function(m){console.log(m)}
	});
}

/**
 * This function updates the order status for any given order
 * @param id is the orderId
 * @param status is the new status for the order
 * @param successFucntion is the success call back function
 */
function updateOrderStatus(id,status,successFunction){
	var data = {userAction:"updateOrderStatus", status:status, orderId: id};
	$.ajax({
		  url: "ajax.php",
		  type: "POST",
		  data: data,
		  success: function(e){
		  	console.log(e);
		  	if(e){
		  		successFunction(id);
		  	} else {
		  		//produce warning flag
		  	}
		  },
		  error: function(jqXHR, textStatus, errorThrown) {
 			console.log(textStatus, errorThrown);
		  }
	});	
}

function updateOrderList(){
	var data = {userAction: 'getOrderList'};
	$.ajax({
		  url: "ajax.php",
		  type: "POST",
		  data: data,
		  success: function(e){
		  	console.log($('#orderList'));
		  	console.log(e);
		  	$('#orderList').replaceWith(e);
		  },
		  error: function(jqXHR, textStatus, errorThrown) {
 			console.log(textStatus, errorThrown);
		  }
	});		
}

/**
 * This function adds a new order to the list view
 * @param orderId is the id associated with the order
 * @param order contains the object for each orderItem
 * @param tableName is the username of the table
 * @param tableId is the id for that table
 */
function addOrderItems(orderId,order,tableName,tableId){
	for(i in order) {
		var item = order[i];
		var newItem = newChefItem + orderId + newChefItem2 + orderId + newChefItem3 + item.quantity + newChefItem4 + item.title + newChefItem5 + item.notes + newChefItem6 + tableId + newChefItem7 + tableName + newChefItem8;
		$('#mealList').append(newItem);
	}
}

/* End Cheff */

/*
 * Customer interactions
 */

 function showDetail(id){
 	var data = {userAction: 'showMenuItemDetail', itemId: id};
 	$.ajax({
		  url: "ajax.php",
		  type: "POST",
		  data: data,
		  success: function(e){
		  	$('#pageBody').html(e);
		  },
		  error: function(jqXHR, textStatus, errorThrown) {
 			console.log(textStatus, errorThrown);
		  }
	});
 }

 function returnToMenu(){
 	var data = {userAction: 'updateMenuItems'};
 	$.ajax({
		  url: "ajax.php",
		  type: "POST",
		  data: data,
		  success: function(e){
		  	$('#pageBody').html(e);
		  },
		  error: function(jqXHR, textStatus, errorThrown) {
 			console.log(textStatus, errorThrown);
		  }
	});	
 }

 function logoutCustomer(){
 	var data = {userAction: 'logoutCustomer'};
	$.ajax({
		  url: "ajax.php",
		  type: "POST",
		  data: data,
		  success: function(e){
		  	$('#custom-bootstrap-menu').replaceWith(e);
		  },
		  error: function(jqXHR, textStatus, errorThrown) {
 			console.log(textStatus, errorThrown);
		  }
	});		
 }

 function searchAndDestroy(menuItems){
 	console.log(menuItems);
 	for(itemId in menuItems){
 		var object = $('.menuItemRow' + itemId);
 		console.log(object);
 		if(object.constructor === Array){

 		} else {
 			if(menuItems[itemId] === 0)
 				$(object).hide();
 		}
 	}
 }

/**
 * This is another abscrated function
 * @param id The id is the id of the table
 */
function payBill(id){
 	updateOrderStatus(id,'Paid',payBillSuccess);
}

/**
 * This is the function that is call back function the customer will use when updating order status
 * @param id The id is the id of the table
 */
var payBillSuccess = function(id) {
 	var dataPub = {tableId: tableId, status: 'Paid'};
	pubnub.publish({
		channel: 'tableUpdate',        
		message: dataPub,
		callback : function(m){console.log(m)}
	});
 	console.log("Paid success");
 	window.location.href = 'index.php';
}

/**
 * This is an abstracted function for sending a specific notification from the customer
 * @param id is the id of the table
 * @param username is the username for the table
 * @param type is the status message to be sent
 */
function pubnubAlert(id,username,type){
	sendMessageFromTable(id,type);
}

/**
 * This allows the user to send a PubNub notification to the wait staff
 * @param id is the id of the table 
 * @param status is the alert status from the table
 */
function sendMessageFromTable(id,status){
	var data = {userAction: 'updateTableStatus', tableId: id, status: status};
	$.ajax({
		  url: "ajax.php",
		  type: "POST",
		  data: data,
		  success: function(e){
		  	console.log(e);
		  	if(e){
		  		pubnub.publish({
				    channel: 'tableUpdate',        
				    message: data,
				    callback : function(m){console.log(m)}
				});
				$('#callButton').hide();
				$('.navbar-left').append('<li id="waiterWait"><a>Waiting for waiter</a></li>')
		  	}
		  },
		  error: function(jqXHR, textStatus, errorThrown) {
 			console.log(textStatus, errorThrown);
		  }
	});
}

/**
 * Customer function for submitting an order
 * NOTE: tableId is a global var in the footer for customers
 */
function submitOrder(){
	$('#warning').fadeToggle(1000);
	var data = {userAction:"submitOrder", order:orderItems, tableId: tableId};
	$.ajax({
		  url: "ajax.php",
		  type: "POST",
		  data: data,
		  success: function(e){
		  	$('#warning').fadeToggle(1000);
		  	if(e !== false){
		  		//Notify waiter and Chef
		  		var obj = JSON.parse(e);
		  		var pubData = {orderId: obj['orderId'], tableId: tableId, status: 'WaitingForFood', order: orderItems, tableName: tableName};
		  		pubnub.publish({
				    channel: 'tableUpdate',        
				    message: pubData,
				    callback : function(m){console.log(m)}
				});

		  		//Add Pay bill link
				showPayBillLink();

		  		$('#success').fadeToggle(2000,function(){
		  			$(this).fadeToggle(2000);
		  		}).delay(1000);
		  		$('#success').show();
		  		orderItems = [];
		  		orderTotal = 0;
		  		itemCount = 0;
		  		updateTotalValues();
		  		resetOrderDropdown();
		  	} else {
		  		$('#danger').fadeToggle(2000,function(){
		  			$(this).fadeToggle(2000);
		  		}).delay(1000);
		  		$('#danger').show();
		  	}
		  },
		  error: function(jqXHR, textStatus, errorThrown) {
 			console.log(textStatus, errorThrown);
		  }
	});
}

/**
 * Finds a orderItem in the dictionary
 * @param id this is the id of a orderItem expected to be in the orderItems dictionary
 * @return orderItem Object if found or false if not found
 */
function inOrder(id) {
	var elementPos = orderItems.map(function(x) {return x.id; }).indexOf(parseInt(id));
	if(elementPos > -1)
		return orderItems[elementPos];
	return false;
}

/**
 * This function updates the orderItems object and updates the view for the cart accordingly
 * @param id is the id for the order item
 * @param title is the title for the order item
 * @param price os the price for the order item
 * @param path is the photo path for the order item
 */
function addItemToOrder(id,title,price,path) {
	var item = {id:id, title:title, price:price, path:path, quantity:1, notes:"N/A"};
	var firstItem = orderItems.length === 0;
	console.log(firstItem);
	if(orderItems.length === 0) { 
		$('#emptyOrder').remove(); 
		var itemHTML = newOrderItem + id + newOrderItem2 + title + newOrderItem33 + 1 + newOrderItem44 + price + newOrderItem55;
		var newItemList = newOrderItem + 'Header' + newOrderItem2 + "Title" + newOrderItem3 + "Qty" + newOrderItem4 + "Price" + newOrderItem5 + '<li role="separator" class="divider"></li>';
		itemHTML += '<li id="totalDivider" role="separator" class="divider"></li>' + newOrderItem + "Total" + newOrderItem2 + "Total" + newOrderItem3 + "" + newOrderItem4 + price + newOrderItem5 + '<li><div style="width100%;text-align:center;margin-top:10px;"><button style="width:90%;margin:auto 0;" type="button" onclick="submitOrder()" class="btn btn-success">SubmitOrder</button></div></li>';
		newItemList += itemHTML;
		$('#orderDropDown').append(newItemList);
	}
	var data = addItemToOrderStructure(item);
	if(data.inList === true){
		var listItem = '#dish' + id;
		$(listItem).find('input[data="quantity"]').val(data.item.quantity);
	} else if(!firstItem && data.added === true) {
		var itemHTML = newOrderItem + id + newOrderItem2 + title + newOrderItem33 + 1 + newOrderItem44 + price + newOrderItem55;
		$('#totalDivider').before(itemHTML);
	}
	updateTotalValues();
}

/**
 * Function that manages the updates to the orderItems data structure
 * @param item is the object to be inserted into the structure
 * @return object {inList: bool, added: bool, id:(optional), item:(optional)}
 */
function addItemToOrderStructure(item) {
	var returnStructure = {inList: false,added:true};
	var existingItem = inOrder(item.id);
	if(existingItem != false) {
		if(existingItem.quantity + 1 < 100) {
			returnStructure.inList = true;
			returnStructure.id = existingItem.id;
			existingItem.quantity++;
			returnStructure.item = existingItem;
		} else {
			returnStructure.added = false;
		}
	} else {
		orderItems.push(item);
	}
	orderTotal += item.price;
	itemCount++;
	return returnStructure;
}

/**
 * Set up the comment box view with the details for the dish they are commenting on
 * @param element This is the order item comment button and is used to get the orderItem in the dictionary
 */
function commentObject(element){
	var par = $(element).parent().parent().parent();
	var id = par[0].id;
	id = id.replace("dish","");
	commentItemPos = orderItems.map(function(x) {return x.id; }).indexOf(parseInt(id));
	$('#commentModalLabel').html('Comments for Dish: ' + orderItems[commentItemPos].title);
	if(orderItems[commentItemPos].notes !== "N/A") {
		$('#commentBox').val(orderItems[commentItemPos].notes);
	}
}

/**
 * Save the comment to the menuItem dictionary
 */
function saveCommentObject() {
	orderItems[commentItemPos].notes = $('#commentBox').val();
	console.log(orderItems);
	$('#commentBox').val(''); //Clear comment box
	$('#commentModal').modal('toggle');
}

//
/**
 * Update the quantity for a given element
 * @param element This is the order item qunatity box and is used to get the orderItem in the dictionary
 */
function updateQuantity(element) {
	var qty = $(element).val();
	var par = $(element).parent().parent().parent();
	var id = par[0].id;  
	id = id.replace("dish","");
	var data = updateQuantityInStructure(id,qty);
	updateTotalValues();
	if(data === true) {
		$(par).remove();
		if(orderItems.length === 0)
			$('#orderDropDown').html('<li id="emptyOrder"><a href="#">Nothing added</a></li>');
	}
	console.log(orderItems);
}

function updateQuantityInStructure(id,qty) {
	var returnStructure = {removed: false, error: false};
	var item = inOrder(id);
	var elementPos = orderItems.map(function(x) {return x.id; }).indexOf(parseInt(id));
	itemCount += qty - item.quantity;
	orderTotal -= item.quantity * item.price;
	orderTotal += qty * item.price;
	if(qty == 0) {
		orderItems.splice(elementPos, 1);
		return true;
	} else {
		orderItems[elementPos].quantity = qty;
		return false;
	}
}

/**
 * Update the total values display
 */
function updateTotalValues(){
	$('#dishTotal #price').html(orderTotal);
	$('#dropdownTitle').html(itemCount + ' Order <span class="caret"></span>');
}

/**
 * Reset to empty basket view
 */
function resetOrderDropdown() {
	var userId = $('#userId').attr('data');
	$('#orderDropDown').html('<li id="emptyOrder"><a href="#">Nothing added</a></li>');
	$('#orderDropDown').after('<li><a href="payBillPage.php?tableId=' + userId + '>Pay Bill</a></li>');
}

/**
 * Show the paybill link next to the basket
 */
function showPayBillLink(){
	if($('#payBillLink').length){
	}else {
		var link = '<li id="payBillLink"><a href="payBillPage.php?tableId=' + tableId + '">Pay Bill</a></li>';
		$('.navbar-right').append(link);
	}
}

/**
 * Remove the paybill link
 */
function removePayBillLink() {
	$('#payBillLink').remove();
}

/**
 * Override dropdown function for twitter bootstrap
 */
$('.dropdown.keep-open').on({
    "shown.bs.dropdown": function() { this.closable = false; },
    "click":             function() { this.closable = true; },
    "hide.bs.dropdown":  function() { return this.closable; }
});

/**
 * Tooltip toggle
 */
$(function () {
    $("[data-toggle='tooltip']").tooltip();
});

/** 
 * Toggle the dropdown
 */
function dropDownToggle(){
	$('#dropdownTitle').addClass('open');
}

/** 
 * This is a test function to log the orderItems to the js console
 * @depricated
 */
function showOrder() {
	console.log("showing order");
	console.log(orderItems);
}

/* End Customer */
