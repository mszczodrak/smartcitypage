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

<h2>OpenWRT Packages</h2>

<p>
OpenWRT provides software packaging system. Similarly to Red-Hat .rpm 
packages, or debian .deb packages, OpenWRT has .ipk packages. 
Before one can install a package, a list of all available packages has
to be downloaded. The following procedure applies to packages officially supported
by OpenWRT comunity. To update and see the list of OpenWRT packages, enter 
the following from a router connect to Internet:
<pre>
$ opkg update
</pre>
</p>

<p>
To enable over the USB serial communication between OpenWRT router
and a mote, the following packages has been identified as necessary:
<ul>
<li>kmod-usb-serial - serial over USB emulation</li>
<li>kmod-usb-serial-ftdi - driver for FTDI USB chips</li>
<li>kmod-usb-serial-cp210x - driver for USB chip on Z1 mote</li>
</ul>
If drivers are correctly installed, after attaching a mote to a WiFi router, 
the serial enabled file /dev/ttyUSB0 should be created.
</p>

<p>
To enable execution of programs collecting data from a mote over serial,
additional packages may be required. For example, is TinyOS tools are
used on the router site, they require python environment, which needs two
more packages:
<ul>
<li>python-mini</li>
<li>pyserial (at this moment the package does not have termios.so library, which 
	has to be manually copied into the router.</li>
</ul>
</p>

<p>
To install all packages mentioned above, the following commands need
to be executed from OpenWRT shell:
<pre>
opkg update
opkg install kmod-usb-serial
opkg install kmod-usb-serial-ftdi
opkg install kmod-usb-serial-cp210x
opkg install python-mini
opkg install pyserial
</pre>
</p>


<h3>OpenWRT Packages for Wireless Sensor Network Support</h3>

<p>
The following packages provide tools that allow OpenWRT router
to monitor attached sensor motes. The tools are provides in a form of
OpenWRT packages, and can be found <a href="./snapshots">here</a>.
The tools are not part of the official OpenWRT package system.
The software's documentation and usage information are available
together with the source code.
The source code is publicably available <a href="./openwrt_source.php">here</a>.
</p>

<p>
To install a package, use opkg from OpenWRT shell. For example,
to install an example test helloworld program for ar71xx architecture, which
is available on TP-Link TL-WR1043ND, do the following from router's shell:
<pre>
opkg install http://smartcity.cs.columbia.edu/openwrt/snapshots/trunk/ar71xx/packages/helloworld_0.01-1_ar71xx.ipk
</pre>
After installation, one can run a simple test as follows:
<pre>
$ helloworld
</pre>
The helloworld package documentation can be found 
<a href="https://github.com/mszczodrak/openwrt-wsn-testbed/tree/master/packages/helloworld">here</a>.
</p>

<p>
The <b>serial2file</b> is a tool that allows to collect data over the USB interface from a mote
using TinyOS based serial communication. The serial data is stored in a local file.
To install serial2file, do the following:
<pre>
opkg install http://smartcity.cs.columbia.edu/openwrt/snapshots/trunk/ar71xx/packages/serial2file_0.06-1_ar71xx.ipk
</pre>
The serial2file package documentation can be found 
<a href="https://github.com/mszczodrak/openwrt-wsn-testbed/tree/master/packages/serial2file">here</a>.
</p>

<p>
The <b>serial2mysql</b> is a tool that allows to collect data over the USB interface from a mote
using TinyOS based serial communication. The serial data is sent to remote MySQL database.
To install serial2mysql, do the following:
<pre>
opkg install http://smartcity.cs.columbia.edu/openwrt/snapshots/trunk/ar71xx/packages/serial2mysql_0.03-2_ar71xx.ipk
</pre>
The serial2mysql package documentation can be found 
<a href="https://github.com/mszczodrak/openwrt-wsn-testbed/tree/master/packages/serial2mysql">here</a>.
</p>

<?php include("../footer.php"); ?>

