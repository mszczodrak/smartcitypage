<?php include("../info.php"); ?>
<body>

<center>
<table>
<tr><td colspan=2>
<?php include("../banner.php"); ?>
</td></tr>

<td aligh='right' valign='top' width='200px'>
<?php include("../menu.php"); ?>
</td>
<td align='left' valign='top' width='700px'>

<h3>Fennec Fox Installation</h3>

<p>
Fennec Fox is the framework for developing reconfigurable network protocol stack.
The framwork is configured by high-level Swift Fox programming language.
At this moment Fennec Fox supports only <a href="http://www.tinyos.net/">
TinyOS operating system</a>. Before Fennec Fox can be installed on a developer's
computer, TinyOS operating system needs to be installed.
</p>

<p>
Documentation for TinyOS installation can be found 
<a href="http://docs.tinyos.net/tinywiki/index.php/Installing_TinyOS_2.1.1">here</a>.
A production oriented support for TinyOS can be found 
<a href="http://www.tinyprod.net/">here</a>
</p>

<p>
Once TinyOS is installed, next download Fennec Fox source code.
The Fennec Fox code is publicably available as a github project and be found 
<a href="https://github.com/mszczodrak/fennec-fox">here</a>.
</p>

<p>
Fennec Fox is a set of modules written in nesC which during 
Swift Fox compilation are combined with the TinyOS operating
systems. Therefire, Fennec Fox module is not a program in
itself, and once it downloaded it only requires to set 
its location within the operating system.
This process has been automated, and it only requires to run the installation
script.
<pre>
$ ./install
</pre>
After installing, reloading the developer's operating system environment 
configurations is necessary. The same can be achieved by reboot the developer's
computers.
</p>

<?php include("../footer.php"); ?>
