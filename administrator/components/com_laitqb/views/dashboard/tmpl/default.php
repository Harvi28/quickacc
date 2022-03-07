<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>

<style type="text/css">

.reviewbox{
	margin-bottom: 10px;
	padding-bottom: 20px;
	border-bottom: 1px solid #2D6CA2;
}

.reviewbox .box{
	padding: 10px;
	height: auto;
	border:1px solid #2D6CA2;
	background: #F0F0F0;
	border-radius: 0px;
	min-width: 150px;
}
.reviewbox .box .content{
	padding: 10px;
	color:  #2D6CA2;
}
.reviewbox .box .content h4{
	font-size: 16px;
	font-weight: 700;
	line-height: 20px;
}
.reviewbox .box .content p{
	font-size: 12px;
	font-weight: 500;

}
</style>


<script>

        jQuery.noConflict()
        let refreshTokenUrl = '<?php echo JRoute::_('index.php?option=com_laitqb&task=dashboard.refreshToken'); ?>';
        var url = '<?php echo $this->authUrl; ?>';
        // console.log(url)

        var OAuthCode = function(url) {

            this.loginPopup = function (parameter) {
                this.loginPopupUri(parameter);
            }

            this.loginPopupUri = function (parameter) {

                // Launch Popup
                var parameters = "location=1,width=800,height=650";
                parameters += ",left=" + (screen.width - 800) / 2 + ",top=" + (screen.height - 650) / 2;

                var win = window.open(url, 'connectPopup', parameters);
                var pollOAuth = window.setInterval(function () {
                    try {

                        if (win.document.URL.indexOf("code") != -1) {
                            window.clearInterval(pollOAuth);
                            win.close();
                            location.reload();
                        }
                    } catch (e) {
                        console.log(e)
                    }
                }, 100);
            }
        }


        var apiCall = function() {
            this.getCompanyInfo = function() {
                /*
                AJAX Request to retrieve getCompanyInfo
                 */
                $.ajax({
                    type: "GET",
                    url: "apiCall.php",
                }).done(function( msg ) {
                    $( '#apiCall' ).html( msg );
                });
            }

            this.refreshToken = function() {
                $.ajax({
                    type: "POST",
                    url: "refreshToken.php",
                }).done(function( msg ) {

                });
            }
        }

        // var account = function(){
        //     this.accInfo = function()
        //     {
        //         die("safd");
        //         //$account = $dataService->FindbyId('account', 95);

        //     }
        // }

        var oauth = new OAuthCode(url);
        var apiCall = new apiCall();
    </script>

<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
</div>



<div id="j-main-container" class="span10">
    <div class="row-fluid">
        <h1>Dashboard</h1>
        <hr>
    </div>

    <div class="row-fluid">
        <div class="span12">

            <div id="accessToken">
            <style="background-color:#efefef;overflow-x:scroll">
                <?php
                if(!empty($this->qb)){
                    echo "<pre>";
                     echo json_encode($this->qb, JSON_PRETTY_PRINT);
                     echo "</pre>";
                    echo '<a class="btn btn-warning" href="" onclick="">Disconnect from QB</a>';
                }else{
                    echo "No Access Token Generated Yet";
                    echo '<a class="btn btn-default" href="#" onclick="oauth.loginPopup()">Connect To QB</a>';
                }
            //echo json_encode($displayString, JSON_PRETTY_PRINT); ?>
            </div>

            <hr />
        </div>
    </div>



	<div class="row-fluid reviewbox">
		<div class="span3 box">
			<div class="content">
                <p><b> QuickBook Detail </b></p>
                <p><b>User : </b><?php /*echo '12'; */?></p>
				<p><b>Email : </b><?php /*echo '40'; */?></p>
			</div>

		</div>

        <div class="span3 box">
			<div class="content">
                <p><b> Synced with QB </b></p>
                <p><b>Customers : </b><?php /*echo '12'; */?></p>
                <p><b>Products : </b><?php /*echo '12'; */?></p>
                <p><b>Vendors : </b><?php /*echo '12'; */?></p>
                <p><b>Orders : </b><?php /*echo '12'; */?></p>
			</div>

		</div>

        <div class="span3 box">
			<div class="content">
				<h4>Tota Customers</h4>
				<p><?php /*echo '150' */?></p>
			</div>

		</div>

        <div class="span3 box">
			<div class="content">
				<h4>Not Sync Orders</h4>
				<p><?php /*echo '20' */?></p>
			</div>

		</div>
	</div>


</div>


<script>

    let setDashData = '<?php echo JRoute::_(JURI::root().'index.php?option=com_laitqb&task=dashboard.actionbro'); ?>';


    jQuery(document).ready(function($){

    });



</script>

