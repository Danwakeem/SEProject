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