var orderItems = [];
var orderTotal = 0;
var itemCount = 0;

var commentItemPos;

var newOrderItem  = '<li id="dish'; //Dish with ID
var newOrderItem2 = '"><div class="row" style="margin-top:10px;"><div class="col-xs-5"><a class="dropdown-col-lt">'; //Add Name 
var newOrderItem3 = '</a></div><div class="col-xs-2"><a id="quantity" class="dropdown-col-rt edit">'; //Quantity goes here

var newOrderItem33 = '</a></div><div class="col-xs-2"><input type="text" id="quantity" class="form-control qty-input" min="0" max="15" value="'; //Quantity goes here
var newOrderItem44 = '" onchange="updateQuantity(this)" ></div><div class="col-xs-2 dropdown-col-rt"><a id="price" class="dropdown-col-rt">'; //Add Price 

var newOrderItem4 = '</a></div><div class="col-xs-2 dropdown-col-rt"><a id="price" class="dropdown-col-rt">'; //Add Price 
var newOrderItem5 = '</a></div><div class="col-xs-1"></div></div></li>';

var newOrderItem55 = '</a></div><div class="col-xs-1 dropdown-col-rt"><a class="dropdown-col-rt" data-toggle="modal" data-target="#myModal" onclick="commentObject(this)"><i class="fa fa-comment-o" title="Comments" rel="tooltip" title="Comments" ></i></a></div></div></li>';


$(document).ready(function(){
	$("[rel='tooltip']").tooltip();
});

var pubnub = PUBNUB.init({
    publish_key: 'pub-c-31dd9891-4fe2-4e6b-b7c7-412e1ec6bc30',
    subscribe_key: 'sub-c-67f9f974-e10d-11e5-b605-02ee2ddab7fe',
    error: function (error) {
        console.log('Error:', error);
    }
})

function subscribeToTables(){
	pubnub.subscribe({
	    channel: 'tables',
	    message: function(m){
			var tableId = '#table' + m['tableID'];
			var findByID = $(tableId);
			findByID.removeClass();
			findByID.addClass('alert alert-danger');
			findByID.empty();
			findByID.html('<p><strong>'+ m['username'] +'</strong> This table <a class="alert-link" href="#">requires assistance</a> <a href="#" style="float:right;">View bill &gt;</a><a onclick="resetTable('+ m['tableID'] +',\''+ m['username'] +'\')" style="float:right;margin-right:10px;cursor: pointer;">Done</a></p>');
			console.log(m)
		},
	    error: function (error) {
	      // Handle error here
	      console.log(JSON.stringify(error));
	    }
	});
}

function sendMessageFromTable(id,username){
	var obj = {'tableID': id,'username': username};
	pubnub.publish({
	    channel: 'tables',        
	    message: obj,
	    callback : function(m){console.log(m)}
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
		  	if(e){
		  		$('#success').fadeToggle(2000,function(){
		  			$(this).fadeToggle(2000);
		  		}).delay(1000);
		  		$('#success').show();
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
			var quantity = '#dish' + id + ' #quantity';
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
}

function commentObject(element){
	var par = $(element).parent().parent().parent();
	var id = par[0].id;
	id = id.replace("dish","");
	commentItemPos = orderItems.map(function(x) {return x.id; }).indexOf(parseInt(id));
	$('#myModalLabel').html('Comments for Dish: ' + orderItems[commentItemPos].title);
}

function saveCommentObject() {
	orderItems[commentItemPos].notes = $('#commentBox').val();
	console.log(orderItems);
	$('#commentBox').val(''); //Clear comment box
	$('#myModal').modal('toggle');
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