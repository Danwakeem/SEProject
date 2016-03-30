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
			var findByID = $('#table5');
			findByID.removeClass();
			findByID.addClass('alert alert-danger');
			findByID.empty();
			findByID.html('<p><strong>Table 3</strong> This table <a class="alert-link" href="#">requires assistance</a> <a href="#" style="float:right;">View bill &gt;</a><a onclick="resetTable(5)" style="float:right;margin-right:10px;cursor: pointer;">Done</a></p>');
			console.log(m)
		},
	    error: function (error) {
	      // Handle error here
	      console.log(JSON.stringify(error));
	    }
	});
}

function sendMessageFromTable(id){
	var obj = {'tableID': id};
	pubnub.publish({
	    channel: 'tables',        
	    message: obj,
	    callback : function(m){console.log(m)}
	});
}

function resetTable(id){
	var findByID = $('#table5');
	findByID.removeClass();
	findByID.addClass('alert alert-info');
	findByID.empty();
	findByID.html('<p><strong>Table 3</strong> Waiting for table to order <a href="#" style="float:right;">View bill &gt;</a></p>');
}