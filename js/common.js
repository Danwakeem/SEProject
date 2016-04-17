var orderItems = [];
var orderTotal = 0;
var itemCount = 0;

var commentItemPos;

//Statuses for managers and waiters
var statusMessages = {
	Ready: 
	{ msg:" Table is ready for customer",
	  class:"alert alert-info table-info", 
	  dropDownButtonClass: "btn btn-primary dropdown-toggle", 
	  dropDownMenuClass: "dropdown-menu status-dropdown-menu ",
	  dropDownButtonText: ' Ready <span class="caret"></span>'
	},
	NeedAssistance:
	{ msg:' This table <a class="alert-link" href="#">requires assistance</a> ',
	  class:'alert alert-danger table-info',
	  dropDownButtonClass: "btn btn-danger dropdown-toggle", 
	  dropDownMenuClass: "dropdown-menu status-dropdown-menu dropdown-red",
	  dropDownButtonText: ' NeedAssistance <span class="caret"></span>'
	},
	CreatingOrder:
	{ msg:' Waiting for table to order ',
	  class:'alert alert-info table-info',
	  dropDownButtonClass: "btn btn-primary dropdown-toggle", 
	  dropDownMenuClass: "dropdown-menu status-dropdown-menu ",
	  dropDownButtonText: ' CreatingOrder <span class="caret"></span>'
	},
	WaitingForFood:
	{ msg:' Waiting for food ',
	  class:'alert alert-info table-info',
	  dropDownButtonClass: "btn btn-primary dropdown-toggle", 
	  dropDownMenuClass: "dropdown-menu status-dropdown-menu ",
	  dropDownButtonText: ' WaitingForFood <span class="caret"></span>'
	},
	OrderReady:
	{ msg:' Food is ready ',
	  class:'alert alert-success table-info',
	  dropDownButtonClass: "btn btn-primary dropdown-toggle", 
	  dropDownMenuClass: "dropdown-menu status-dropdown-menu ",
	  dropDownButtonText: ' Order Ready <span class="caret"></span>'
	},
	FoodDelivered:
	{ msg:' Waiting For payment ',
	  class:'alert alert-info table-info',
	  dropDownButtonClass: "btn btn-primary dropdown-toggle", 
	  dropDownMenuClass: "dropdown-menu status-dropdown-menu ",
	  dropDownButtonText: ' FoodDelivered <span class="caret"></span>'
	},
	Paid:
	{ msg:' Paid and <span class="alert-link">needs to be cleared.</span>',
	  class:'alert alert-warning table-info',
	  dropDownButtonClass: "btn btn-primary dropdown-toggle", 
	  dropDownMenuClass: "dropdown-menu status-dropdown-menu ",
	  dropDownButtonText: ' Paid <span class="caret"></span>'
	}
}

//Customer order cart stuff
var newOrderItem  = '<li id="dish'; //Dish with ID
var newOrderItem2 = '"><div class="row" style="margin-top:10px;"><div class="col-xs-5"><a class="dropdown-col-lt">'; //Add Name 
var newOrderItem3 = '</a></div><div class="col-xs-2"><a id="quantity" class="dropdown-col-rt edit">'; //Quantity goes here
var newOrderItem33 = '</a></div><div class="col-xs-2"><input type="text" id="quantity" class="form-control qty-input" min="0" max="15" value="'; //Quantity goes here
var newOrderItem44 = '" onchange="updateQuantity(this)" ></div><div class="col-xs-2 dropdown-col-rt"><a id="price" class="dropdown-col-rt">'; //Add Price 
var newOrderItem4 = '</a></div><div class="col-xs-2 dropdown-col-rt"><a id="price" class="dropdown-col-rt">'; //Add Price 
var newOrderItem5 = '</a></div><div class="col-xs-1"></div></div></li>';
var newOrderItem55 = '</a></div><div class="col-xs-1 dropdown-col-rt"><a class="dropdown-col-rt" data-toggle="modal" data-target="#commentModal" onclick="commentObject(this)"><i class="fa fa-comment-o" title="Comments" rel="tooltip" title="Comments" ></i></a></div></div></li>'; 

$(document).ready(function(){
	$("[rel='tooltip']").tooltip();
});

var pubnub = PUBNUB.init({
    publish_key: 'pub-c-31dd9891-4fe2-4e6b-b7c7-412e1ec6bc30',
    subscribe_key: 'sub-c-67f9f974-e10d-11e5-b605-02ee2ddab7fe',
    error: function (error) {
        console.log('Error:', error);
    }
});

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

function subscribeToTableUpdates(){
	pubnub.subscribe({
		channel: 'tableUpdate',
		message: function(e){
			if(userType === 'waiter') {
				changeTableStatus(e['tableId'],e['status'],false);
			} else if (userType === 'chef' && e['status'] === 'WaitingForFood') {
				console.log(e['orderId']);
				addOrderItems(e['orderId'],e['order'],e['tableName'],e['tableId']);
			}
		},
		error: function(error){
			console.log(JSON.stringify(error));
		}
	});
}

/*
 * Waiter interactions
 */

 var customerPaidFunction = function(data) {
 	if(userType === 'waiter') {
 		console.log(data);
 		changeTableStatus(data['tableId'], data['status'], false);

 	}
 }

function changeTableStatus(id,status,updateDB) {
	if(updateDB){
		var updateInfo = statusMessages[status];
		var data = {userAction:'updateTableStatus',status:status,tableId:id};
		updateDBTableStatus(updateInfo,data,id);
	} else {
		var updateInfo = statusMessages[status];
		updateTableUI(updateInfo,id);
		if(status == 'WaitingForFood'){
			//Add view bill button
		} else if(status === 'Paid') {
			//Remove view bill button
		}
	}
}

function updateDBTableStatus(updateInfo,data,id){
	$.ajax({
		  url: "ajax.php",
		  type: "POST",
		  data: data,
		  success: function(e){
		  	console.log(e);
		  	if(e){
		  		updateTableUI(updateInfo,id);
		  	} else {
		  		//Warning flag
		  	}
		  },
		  error: function(jqXHR, textStatus, errorThrown) {
 			console.log(textStatus, errorThrown);
		  }
	});
}

function updateTableUI(updateInfo,id){
	console.log("updating UI");
	$('#msg' + id).html(updateInfo.msg);
	$('#table' + id).removeClass().addClass(updateInfo.class);
	$('#statusButton' + id).removeClass().addClass(updateInfo.dropDownButtonClass).html(updateInfo.dropDownButtonText);
	$('#dropDownMenu' + id).removeClass().addClass(updateInfo.dropDownMenuClass);
}

/*
 * Chef interactions
 */

function checkOrderRadios(element) {
	var classId = $(element).attr('class');
	if($('.' +classId+':checked').length === $('.'+classId).length){
		updateOrderStatus(classId,'ReadyForDelivery',updateMealList);
	}
}

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

//New orders for chef
var newChefItem  = '<tr class="orderRow'; //OrderId
var newChefItem2 = '"><td><div class="checkbox"><label><input class="'; //OrderId
var newChefItem3 = '" onclick="checkOrderRadios(this)" type="checkbox" value=""></label></div></td><td>'; //Quantity
var newChefItem4 = '</td><td>'; //Title
var newChefItem5 = '</td><td>'; //notes
var newChefItem6 = '</td><td id="tableId" data="'; //TableId
var newChefItem7 = '">'; //userName
var newChefItem8 = '</td></tr>';

function addOrderItems(orderId,order,tableName,tableId){
	console.log(orderId);
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

 function payBill(id){
 	updateOrderStatus(id,'Paid',payBillSuccess);
 }

 var payBillSuccess = function(id) {
 	var dataPub = {tableId: tableId, status: 'Paid'};
	pubnub.publish({
		channel: 'tableUpdate',        
		message: dataPub,
		callback : function(m){console.log(m)}
	});
 	console.log("Paid success");
 }

function pubnubAlert(id,username,type){
	sendMessageFromTable(id,type);
}

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
		  	}
		  },
		  error: function(jqXHR, textStatus, errorThrown) {
 			console.log(textStatus, errorThrown);
		  }
	});
}

function resetTable(id,username){
	var section = "#table" + id;
	var findByID = $(section);
	findByID.removeClass();
	findByID.addClass('alert alert-info');
	findByID.empty();
	findByID.html('<p><strong>'+ username +'</strong> Waiting for table to order <a href="#" style="float:right;">View bill &gt;</a></p>');
}

function submitOrder(){
	$('#warning').fadeToggle(1000);
	var data = {userAction:"submitOrder", order:orderItems};
	$.ajax({
		  url: "ajax.php",
		  type: "POST",
		  data: data,
		  success: function(e){
		  	$('#warning').fadeToggle(1000);
		  	if(e !== false){
		  		//Notify waiter and Chef
		  		var obj = JSON.parse(e);
		  		console.log(e['orderId']);
		  		var pubData = {orderId: obj['orderId'], tableId: tableId, status: 'WaitingForFood', order: orderItems, tableName: tableName};
		  		pubnub.publish({
				    channel: 'tableUpdate',        
				    message: pubData,
				    callback : function(m){console.log(m)}
				});

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

function inOrder(id) {
	var elementPos = orderItems.map(function(x) {return x.id; }).indexOf(parseInt(id));
	if(elementPos > -1)
		return orderItems[elementPos];
	return false;
}

function addItemToOrder(id,title,price,path) {
	if(orderItems.length == 0) {
		var item = {id:id, title:title, price:price, path:path, quantity:1, notes:"N/A"};
		orderItems.push(item);
		var itemHTML = newOrderItem + id + newOrderItem2 + title + newOrderItem33 + 1 + newOrderItem44 + price + newOrderItem55;
		var newItemList = newOrderItem + 'Header' + newOrderItem2 + "Title" + newOrderItem3 + "Qty" + newOrderItem4 + "Price" + newOrderItem5 + '<li role="separator" class="divider"></li>';
		itemHTML += '<li id="totalDivider" role="separator" class="divider"></li>' + newOrderItem + "Total" + newOrderItem2 + "Total" + newOrderItem3 + "" + newOrderItem4 + price + newOrderItem5 + '<li><div style="width100%;text-align:center;margin-top:10px;"><button style="width:90%;margin:auto 0;" type="button" onclick="submitOrder()" class="btn btn-success">SubmitOrder</button></div></li>';
		newItemList += itemHTML;
		$('#emptyOrder').remove();
		$('#orderDropDown').append(newItemList);
	} else {
		var item = inOrder(id);
		if(item != false){
			item['quantity']++;
			var listItem = '#dish' + id;
			var quantityBox = $(listItem).find('#quantity')[0];
			$(quantity).val(item['quantity']);
		} else {
			var item = {id:id, title:title, price:price, path:path, quantity:1, notes:"N/A"};
			orderItems.push(item);
			var itemHTML = newOrderItem + id + newOrderItem2 + title + newOrderItem33 + 1 + newOrderItem44 + price + newOrderItem55;
			$('#totalDivider').before(itemHTML);

		}
	}
	orderTotal += price;
	itemCount++;
	updateTotalValues();
	console.log(orderItems);
}

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

function saveCommentObject() {
	orderItems[commentItemPos].notes = $('#commentBox').val();
	console.log(orderItems);
	$('#commentBox').val(''); //Clear comment box
	$('#commentModal').modal('toggle');
}

function updateQuantity(element){
	var qty = $(element).val();
	var par = $(element).parent().parent().parent();
	var id = par[0].id;  
	id = id.replace("dish","");
	var item = inOrder(id);
	var elementPos = orderItems.map(function(x) {return x.id; }).indexOf(parseInt(id));
	itemCount += qty - item.quantity;
	orderTotal -= item.quantity * item.price;
	orderTotal += qty * item.price;
	updateTotalValues();
	if(qty == 0){
		orderItems.splice(elementPos, 1);
		$(par).remove();
		if(orderItems.length === 0)
			$('#orderDropDown').html('<li id="emptyOrder"><a href="#">Nothing added</a></li>');
	} else {
		orderItems[elementPos].quantity = qty;
	}
}

function updateTotalValues(){
	$('#dishTotal #price').html(orderTotal);
	$('#dropdownTitle').html(itemCount + ' Order <span class="caret"></span>');
}

function resetOrderDropdown() {
	var userId = $('#userId').attr('data');
	$('#orderDropDown').html('<li id="emptyOrder"><a href="#">Nothing added</a></li>');
	$('#orderDropDown').after('<li><a href="payBillPage.php?tableId=' + userId + '>Pay Bill</a></li>');
}

//Override dropdown function for twitter bootstrap
$('.dropdown.keep-open').on({
    "shown.bs.dropdown": function() { this.closable = false; },
    "click":             function() { this.closable = true; },
    "hide.bs.dropdown":  function() { return this.closable; }
});

//Tooltip toggle
$(function () {
    $("[data-toggle='tooltip']").tooltip();
});

function dropDownToggle(){
	$('#dropdownTitle').addClass('open');
}

function showOrder() {
	console.log("showing order");
	console.log(orderItems);
}

/* End Customer */