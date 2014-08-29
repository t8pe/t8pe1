/* 
* Player functions for the bd-jplayer plugin, to integrate it into t8pe - payments, play tracking etc.
* v0.1
* Ben Deschamps
*/

/* Why exactly am I doing everything in the js file in php? */

function t8pe1_count_play(){
// When play reaches 30 seconds, this triggers a PHP script to increment the "plays" count by 1.
// Not sure that this is going to work, so consider this pseudocode for now. And it doesn't work! 
    // total_plays = get_post_meta( $post->ID, 'total_plays');
    // total_plays++;
    // update_post_meta( $post->ID, 'total_plays', total_plays);

   <?php t8pe1_play_counter(); ?>
}

function t8pe1_trigger_pay(){
// When play ends, this takes $chosen_price and transfers it from User's account to Artist's account.
// Same thing here. Waiting for the googles!

    total_sales = get_post_meta( $post->ID, 't8pe_total_sales_metabox');
    total_sales++;
    update_post_meta( $post->ID, 't8pe_total_sales_metabox', total_sales);

}

// $("#jquery_jplayer_N").bind($.jPlayer.event.play, function(event) { // Add a listener to report the time play began
// $("#playBeganAtTime").alert("Play began at time = " + event.jPlayer.status.currentTime);
// });

