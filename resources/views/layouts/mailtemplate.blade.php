<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
</head>

<body>

	<table width="90%" align="center" border="0" cellspacing="0" cellpadding="0"
		style="max-width:650px;width:90%;border:1px solid #d4d4d4">
		<tbody>

			<tr>
				<td align="center">
					<img src="https://img.ebpd.in/crn/website/logmein/thank-you.jpg" alt=""
						width="100%" style="display:table">
				</td>
			</tr>

			<tr align="left">
				<td
					style="font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;font-size:12px;line-height:22px;color:#000;padding:0 25px 25px 25px"
					valign="top">
					<h6
						style="color:#000;margin:0 auto;padding:8px 0;line-height:24px;font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;font-size:15px;width:80%;margin:25px 5px 0 5px">
						Dear {{ $name ?? '' }},</h6>

					<p
						style="color:#000;margin:0 auto;padding:8px 0;margin:0 7px 0 5px;line-height:24px;font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;font-size:13px;font-weight:normal">
						<span>{{ session()->get('username') }} </span> has sent you a private message via Sap Digital Maharashtra 2020 Event, the
						message is as under - </p>

					<p
						style="color:#000;margin:0 auto;padding:15px;margin:0 7px 0 5px;line-height:24px;font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;font-size:13px;font-weight:normal;font-style: italic;background: #e5e5e5;border-radius: 6px;">
						{{ $content ?? '' }}</span> </p>

					<p
						style="font-weight:normal;color:#000;font-size:13px;font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;margin:0 7px 0 3px;word-spacing:0px;padding:8px 0;line-height:25px;">
						Contact Details are as follows - </p>

					<p
						style="color:#000;margin:0 auto;padding:8px 0;margin:0 7px 0 5px;line-height:20px;font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;font-size:13px">
						<span style="color:#4b5aa3;font-weight:bold">Name: - </span> <a href="javascript:"
							style="text-decoration:none;color:#000;font-weight:bold">{{ session()->get('username') ?? '' }}</a> </p>

					<p
						style="color:#000;margin:0 auto;padding:8px 0;margin:0 7px 0 5px;line-height:20px;font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;font-size:13px">
						<span style="color:#4b5aa3;font-weight:bold">Designation: - </span> <a href="javascript:"
							style="text-decoration:none;color:#000;font-weight:bold">{{ session()->get('job_title') ?? '' }}</a></p>

					<p
						style="color:#000;margin:0 auto;padding:8px 0;margin:0 7px 0 5px;line-height:20px;font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;font-size:13px">
						<span style="color:#4b5aa3;font-weight:bold">Company: - </span> <a href="javascript:"
							style="text-decoration:none;color:#000;font-weight:bold">{{ session()->get('company') ?? '' }}</a></p>

					<p
						style="color:#000;margin:0 auto;padding:8px 0;margin:0 7px 0 5px;line-height:20px;font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;font-size:13px">
						<span style="color:#4b5aa3;font-weight:bold">Email: - </span> <a href="javascript:"
							style="text-decoration:none;color:#000;font-weight:bold">{{ session()->get('useremail') ?? '' }}</a></p>

					<p
						style="color:#000;margin:0 7px 0 5px;padding:8px 0;font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;font-size:13px;font-weight:bold">
						<span style="color:#4b5aa3;font-size:14px">Thanks,</span> <br>
						Team Back to Work <br>
						<a href="https://backtowork.expresscomputer.in/" style="color:#000;text-decoration:none"
							target="_blank">backtowork.expresscomputer.in</a></p>

				</td>
			</tr>

			<tr bgcolor="#252525">
				<td style="height:5px">
					<p
						style="color:#fff;font-size:12px;font-family:Verdana,&#39;sans-serif&#39;,Calibri,Arial;margin:0 5px 0 5px;word-spacing:1px;padding:15px;text-align:center">
						© The Indian Express (P) Ltd. Event managed by Business Publications Division.</p>
				</td>
			</tr>

		</tbody>
	</table>

</body>

</html>