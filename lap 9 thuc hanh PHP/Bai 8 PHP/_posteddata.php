<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Sample &mdash; CKEditor Posted Data</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<style>
		body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #f4f7f6; padding: 30px; }
		table { width: 100%; border-collapse: collapse; background: #fff; margin-top: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
		th, td { padding: 12px 15px; border: 1px solid #ddd; text-align: left; vertical-align: top; }
		th { background: #3498db; color: #fff; }
		pre { white-space: pre-wrap; word-wrap: break-word; font-family: Consolas, monospace; }
	</style>
</head>
<body>
	<h1>CKEditor &mdash; Posted Data</h1>
	<table border="1" cellspacing="0">
		<thead>
			<tr>
				<th style="width: 200px;">Field Name</th>
				<th>Value</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$postArray = &$_POST;
		foreach ( $postArray as $sForm => $value )
		{
			$postedValue = htmlspecialchars( $value );
		?>
			<tr>
				<th><?php echo htmlspecialchars($sForm); ?></th>
				<td><pre><?php echo $postedValue; ?></pre></td>
			</tr>
		<?php
		}
		?>
		</tbody>
	</table>
</body>
</html>