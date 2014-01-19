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

<p>
<a href="https://openwrt.org/">OpenWrt</a> is an embedded Linux distribution
for wireless routers. The OpenWRT project website contains a lot of detailed
information and has active development community support. Each OpenWRT 
system is customized for a given WiFi router, with the list of all supported
routers available <a href="http://wiki.openwrt.org/toh/start">here</a>.
Most supported routers have their own dedicated websites, for example, 
detailed information about OpenWRT support for TP-Link TL-WR1043ND
can be found <a href="http://wiki.openwrt.org/toh/tp-link/tl-wr1043nd">here</a>.
</p>

<h3>Quick Dive into OpenWRT</h3>

<p>
The fastest way to start working with OpenWRT is by downloading and
installing pre-compiled image firmware. The list of all latest stable
firmwares can be found
<a href="http://downloads.openwrt.org/backfire/10.03.1/ar71xx/">here</a>.
For example, for TP-Link TL-WR1043ND router, download 
<a href="http://downloads.openwrt.org/backfire/10.03.1/ar71xx/openwrt-ar71xx-tl-wr1043nd-v1-squashfs-factory.bin">
this image</a>. As an alternative to downloading ready-made firmware, 
one can also build the firmware from source, following 
<a href="http://wiki.openwrt.org/doc/start#building">these instructions</a>.
</p>

<p>
Once we have a firmware image of the OpenWRT system for a given router,
next we need to install it. There are two ways of installing the firmware,
through router's web interface, and from router's shell. In either case,
before the installation begins, a computer with OpenWRT system image
must be connected through Ethernet to the router, on router's LAN interface.
<ul>
<li>Web-based installation: if a router provides web-interface 
(e.g. check http://192.168.1.1), use that interface and search for firmware upgrade page and
follow the instruction of that router.</li>
<li>Shell installation: copy the system image into the router, using ftp or ssh
(sometimes, one needs to first telnet to the router to setup ssh and/or ftp).
Once the image is copied, login to the router's shell using telnet or ssh and 
install the image. For example, if the new firmware file was copied to /tmp at router, do
<pre>
$ mtd -r write /tmp/<firmware_file_name>.bin firmware
</pre>
TP-Link TL-WR1043ND owners would do
<pre>
$ mtd -r write /tmp/openwrt-ar71xx-tl-wr1043nd-v1-squashfs-factory.bin firmware 
</pre></li>
</ul>
At this point, the router should reboot and be configured with default settings, 
with IP 192.168.1.1.
</p>


<h3>How to Restore Broken TP-Link TL-WR1043ND</h3>

<p>
Once in a while something goes wrong and we cannot connect to
the router anymore. To restore wifi router's default configuration
(to debrick) one needs to follow a nonstandard procedure, unique
for each router. The following are the steps that may restore
default configuration on TP-Link TL-WR1043ND:
</p>

<ol>
<li>Enter router's failsafe mode
<ul>
<li>Unplug the power cord from a router</li>
<li>Connect to router via LAN from a PC that has a static IP 192.168.1.2</li>
<li>Plug in the router to power</li>
<li>Press QSS few times (or simply hold it pressed)</li>
<li>wait till SYS LED flashes 3x per second</li>
<li>Release QSS</li>
</ul>
</li>
<li>From PC
<ul>
<li>Connect to Wifi router through telnet <pre>$ telnet 192.168.1.1</pre></li>
<li>Erase user's configurations on the wifi router <pre>$ mtd -r erase rootfs_data</pre></li>
</ul>
</li>
</ol>


<?php include("../footer.php"); ?>

