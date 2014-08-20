/* 
* Player functions for the bd-jplayer plugin, to integrate it into t8pe - payments, play tracking etc.
* v0.1
* Ben Deschamps
*/

function t8pe1_count_play(){
// When play reaches 30 seconds, this triggers a PHP script to increment the "plays" count by 1.
    if (event.jPlayer.status.currentTime > 15) {
    alert('t8pe1_count_play successfully triggered!');
}
}

function t8pe1_trigger_pay(){
// When play ends, this takes $chosen_price and transfers it from User's account to Artist's account.
    alert('t8pe1_trigger_pay successfully triggered!');
}

// $("#jquery_jplayer_N").bind($.jPlayer.event.play, function(event) { // Add a listener to report the time play began
// $("#playBeganAtTime").alert("Play began at time = " + event.jPlayer.status.currentTime);
// });

$("#jquery_jplayer_N").bind($.jPlayer.event.play, function(event) {
    alert('it plays!');
});