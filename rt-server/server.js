var redis = require('redis');
var io = require('socket.io')(9000);
var io_sync = io.of('/sync');


var client = redis.createClient();

client.subscribe('sync:listing');

client.on('message', function(channel, message){
    channelHandler.handle(channel, message);
});


var channelHandler = {
    channel: {
        sync_listing_progress: 'sync:listing:progress',
        sync_listing: 'sync:listing',
    },
    handle: function(channel, msg){
        if(channel == this.channel.sync_listing_progress){
            io_sync.to('sync:listing:' + msg.store_id).emit('sync:listing:progress', msg.msg);
        }
        if(channel == this.channel.sync_listing){
            io_sync.to('sync:listing:' + msg.store_id).emit('sync:listing', msg.msg);
        }
    }
};


