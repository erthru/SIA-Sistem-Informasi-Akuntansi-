<?php
class config{
	public function siteurl(){
		return "http://localhost/Anows/sia";
	}
	
	public function koneksi(){
		return mysqli_connect("localhost","root","","sia");
	}
}
?>