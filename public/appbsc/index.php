<?php
echo "
<html>
<header>
</header>";

if ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {
	$iPod = stripos( $_SERVER['HTTP_USER_AGENT'], "iPod" );
	$iPhone = stripos( $_SERVER['HTTP_USER_AGENT'], "iPhone" );
	$iPad = stripos( $_SERVER['HTTP_USER_AGENT'], "iPad" );
	$Android = stripos( $_SERVER['HTTP_USER_AGENT'], "Android" );
	$webOS = stripos( $_SERVER['HTTP_USER_AGENT'], "webOS" );
	
	// detect os version
	if ( $iPod || $iPhone || $iPad ) {
    // redirect to ipa file download
        ?><script type="text/javascript">
window.location.href = 'https://itunes.apple.com/ec/app/barcelona-sc-oficial/id1127538792?mt=8';
</script><?

		die();
	} else if ( $Android ) {
	  // redirect to apk file download

	       ?><script type="text/javascript">
window.location.href = 'https://play.google.com/store/apps/details?id=com.BarcelonaSC.BarcelonaApp&hl=es_419';
</script><?

		die();
	}else{

	   ?><script type="text/javascript">
window.location.href = 'https://barcelonasc.com.ec/';
</script><?

	}
} else { 
 ?><script type="text/javascript">
window.location.href = 'https://barcelonasc.com.ec/';
</script><?
}

echo "</html>";
?>