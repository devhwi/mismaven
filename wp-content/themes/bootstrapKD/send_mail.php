<?php
	$name	 = $_POST['name'];
	$email	 = $_POST['email'];
	$message = $_POST['message'];

	$to = "mismaven2015@gmail.com";
	$from = $email;

	$header = "Content-Type: text/html; charset=utf-8 \r\n";
	$header .= "From: $name <$email>\r\n";

	mail($to, "{$name}의 MAVEN을 향한 이메일입니다.", $message, $header);

	echo "<script>alert('전송 완료!'); location.href='http://mismaven.kr/?page_id=216';</script>";
?>