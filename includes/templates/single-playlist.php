<?php
/**
 * The Template for displaying single Playlists
 *
 */

get_header(); ?>

<div id="primary" class="content-area">
<div id="content" class="site-content" role="main">

<?php
  while (have_posts() ) : the_post();
?>

<script type="text/javascript">

jQuery(document).ready(function($) {
    var myPlaylist = new jPlayerPlaylist({
	jPlayer: "#jquery_jplayer_N",
	cssSelectorAncestor: "#jp_container_N"
    },
      [
    
<?php
// Using songlist meta to drive the song pseudoloop:
$songs = get_post_meta( $post->ID, 'songlist', 'true' );
$song_array = explode( ',', $songs );
foreach ( $song_array as $song ){
  $song_obj = get_post( $song );

  $songs_array = array( 'title'      => $song_obj->post_title, 
			'artist'     => $song_obj->post_author,
			'mp3'        => $song_obj->mp3,
			'oga'        => $song_obj->ogg,
			'poster'     => $song_obj->post_thumbnail,
			'ID'         => $song_obj->ID // Using this to try to pass an ID to the payment module
			);

  echo json_encode($songs_array, JSON_UNESCAPED_SLASHES) . ",";
}

endwhile;
?>



       ],{
	playlistOptions: {
	    enableRemoveControls: true
	},
	swfPath: "/js",
	supplied: "oga,mp3",
	smoothPlayBar: true,
	keyEnabled: true,
	audioFullScreen: true,
        cssSelectorAncestor: '#jp_container_N',
        cssSelector: {
	    videoPlay: '.jp-video-play',
	    play: '.jp-play',
	    pause: '.jp-pause',
	    stop: '.jp-stop',
	    seekBar: '.jp-seek-bar',
	    playBar: '.jp-play-bar',
	    mute: '.jp-mute',
	    unmute: '.jp-unmute',
	    volumeBar: '.jp-volume-bar',
	    volumeBarValue: '.jp-volume-bar-value',
	    volumeMax: '.jp-volume-max',
	    playbackRateBar: '.jp-playback-rate-bar',
	    playbackRateBarValue: '.jp-playback-rate-bar-value',
	    currentTime: '.jp-current-time',
	    duration: '.jp-duration',
	    title: '.jp-title',
	    fullScreen: '.jp-full-screen',
	    restoreScreen: '.jp-restore-screen',
	    repeat: '.jp-repeat',
	    repeatOff: '.jp-repeat-off',
	    gui: '.jp-gui',
	    noSolution: '.jp-no-solution'
	    }

 // Allows the audio poster to go full screen via keyboard
	  }); // end Playlist part
  


 $("#jquery_jplayer_N").bind($.jPlayer.event.timeupdate, function(event) { 

   
    if(event.jPlayer.status.currentPercentAbsolute > 2 && event.jPlayer.status.currentPercentAbsolute < 3) {
    
     
      <?php setPlayCount(71); ?>   


      /* Still need to be sure of how to get the ID */


      /* // Need to add a cond to see if the meta exists, and add if it doesn't */
      /* $songID = 71;       */

      /* $total_plays = get_post_meta( $songID, 'total_plays', true );  */

      /* if ( empty ( $total_plays ) ) */
      /* add_post_meta( $songID, 'total_plays', '0' ); */
      

      /* $total_plays++; */
      /* update_post_meta( $songID, 'total_plays', $total_plays ); //was 71 */
      
/* Will put this part in as soon as I get $post-> ID working the way it should.
      if (! get_post_meta( $post, 'total_revenue' ):
      add_post_meta( $post, 'total_revenue', '0' );
      $total_revenue = intval( get_post_meta( $post, 'total_revenue', true )); 
      $total_revenue++; // until I add the Dial, this will have to just add 1 to the revenue
      update_post_meta( 71, 'total_revenue', $total_revenue ); 
      */


  }
   }); // Works fine - but only triggers ONCE before needing a reload, so no replay.

  });


</script>



<div class="entry-content">
<div id="jp_container_N">
<div id="jp_container_N" class="jp-video jp-video-270p">
  <div class="jp-type-playlist">
    <div id="jquery_jplayer_N" class="jp-jplayer"></div>
    <div class="jp-gui">
      <div class="jp-video-play">
	<a href="javascript:;" class="jp-video-play-icon" tabindex="1">play</a>
      </div>
      <div class="jp-interface">
	<div class="jp-progress">
	  <div class="jp-seek-bar">
	    <div class="jp-play-bar"></div>
	  </div>
	</div>
	<div class="jp-current-time"></div>
	<div class="jp-duration"></div>
	<div class="jp-details">
	  <ul>
	    <li><span class="jp-title"></span></li>
	  </ul>
	</div>
	<div class="jp-controls-holder">
	  <ul class="jp-controls">
	    <li><a href="javascript:;" class="jp-previous" tabindex="1">previous</a></li>
	    <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
	    <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
	    <li><a href="javascript:;" class="jp-next" tabindex="1">next</a></li>
	    <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
	    <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
	    <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
	    <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
	  </ul>
	  <div class="jp-volume-bar">
	    <div class="jp-volume-bar-value"></div>
	  </div>
	  <ul class="jp-toggles">
	    <li><a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen">full screen</a></li>
	    <li><a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen">restore screen</a></li>
	    <li><a href="javascript:;" class="jp-shuffle" tabindex="1" title="shuffle">shuffle</a></li>
	    <li><a href="javascript:;" class="jp-shuffle-off" tabindex="1" title="shuffle off">shuffle off</a></li>
	    <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
	    <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
	  </ul>
	</div>
      </div>
    </div>

    <div class="jp-playlist">
      <ul>
	<!-- The method Playlist.displayPlaylist() uses this unordered list -->
	<li></li>
      </ul>
    </div>
    <div class="jp-no-solution">
      <span>Update Required</span>
      To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
    </div>
  </div>
</div>
</div></div>
<p style="margin-top:1em;">


  //END

</div><!-- #content -->
</div><!-- #primary -->

<?php 
		get_sidebar( 'content' );
		get_sidebar();
		get_footer();
