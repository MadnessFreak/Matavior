<!DOCTYPE html>
<html>
	<head>
		<title>Fatal error: <?php echo Utility::encodeHTML($this->getMessage()); ?></title>
		<meta charset="utf-8" />
		<style type="text/css">
			/**
			 * #34495E	WET ASPHALT
			 * #2C3E50	MIDNIGHT BLUE
			 * 
			 * #95A5A6	CONCRETE
			 * #7F8C8D	ASBESTOS
			 * 
			 * #ECF0F1	CLOUDS
			 * #BDC3C7	SILVER
			 */
			body {
				font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
				font-size: 0.8em;
				background-color: #ECF0F1;
			}

			div {
				background-color: lightgray;
			}
			
			div div {
				padding: 10px;
			}

			code {
				font-family: Verdana, Helvetica, sans-serif;
				font-size: 0.8em;
			}
			
			h1 {
				background-color: #34495e;
				padding: 10px;
				color: #fff;
				margin: 0 0 3px 0;
				font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
				font-size: 1.25em;
				font-weight: 500;
				line-height: 1.1;
				opacity: .8;
			}
			h2 {
				font-size: 18px;
				font-weight: 400;
				line-height: 1.1;
				margin-bottom: 0;
				opacity: .8;
			}

			b {
				font-weight: 500;
			}
			
			pre, p {
				margin: 0;
				font-size: 1.1em;
			}

			code {
				font-family: Menlo, Monaco, Consolas, "Courier New", monospace;
				font-size: 1.1em;
			}
		</style>
	</head>
	<body>
		<div>
			<h1>Fatal error: <?php echo Utility::encodeHTML($this->getMessage()); ?></h1>
			<?php if (Mata::debugModeIsEnabled()) { ?>
				<div>
					<?php if ($this->getDescription()) { ?><p><br /><?php echo $this->getDescription(); ?></p><?php } ?>
					
					<h2>Information:</h2>
					<p class="detail">
						<b>Hash:</b> <code><?php echo $this->getHash(); ?></code><br>
						<b>Error message:</b> <?php echo Utility::encodeHTML($this->getMessage()); ?><br>
						<b>Error code:</b> <?php echo intval($e->getCode()); ?><br>
						<?php #echo $this->information; ?>
						<b>File:</b> <?php echo Utility::encodeHTML($e->getFile()); ?> (<?php echo $e->getLine(); ?>)<br>
						<b>PHP version:</b> <?php echo Utility::encodeHTML(phpversion()); ?><br>
						<b>Mata version:</b> <?php echo MATA_VERSION; ?><br>
						<b>Date:</b> <?php echo gmdate('r'); ?><br>
						<b>Request:</b> <?php if (isset($_SERVER['REQUEST_URI'])) echo Utility::encodeHTML($_SERVER['REQUEST_URI']); ?><br>
						<b>Referer:</b> <?php if (isset($_SERVER['HTTP_REFERER'])) echo Utility::encodeHTML($_SERVER['HTTP_REFERER']); ?><br>
					</p>
					
					<h2>Stacktrace:</h2>
					<pre class="detail"><?php echo Utility::encodeHTML($this->getTraceAsString()); ?></pre>
				</div>
			<?php } else { ?>
				<div>
					<h2>Information:</h2>
					<p>
						<?php if (!$this->getHash()) { ?>
							Unable to write log file, please make &quot;<?php echo Utility::unifyDirSeparator(WCF_DIR); ?>log/&quot; writable!
						<?php } else { ?>
							<b>ID:</b> <code><?php echo $this->getHash(); ?></code><br>
							<?php echo $innerMessage; ?>
						<?php } ?>
					</p>
				</div>
			<?php } ?>
			
			<?php #echo $this->functions; ?>
		</div>
	</body>
</html>