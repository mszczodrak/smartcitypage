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

<h2>Wireless Sensor Network Testbed</h2>

<p>
At this time the wireless sensor network testbed has 3 nodes. 
Each node consists of a mote and a WiFi router connected together with a USB cable. 
The testbed uses the <a href='http://www.zolertia.com/ti'>Zolertia Z1</a> 
motes to which <a href='http://www.phidgets.com/products.php?category=1'>Phidget sensors</a>
are attached: motion detection and sound sensors. 
The WiFi routers are the <a href='http://www.tp-link.com/en/products/details/?model=TL-WR1043ND'>
TP-LINK 1043ND</a> routers running <a href='https://openwrt.org/'>OpenWRT</a> 
embedded Linux operating system. The picture below shows one of the nodes of the WSN testbed.

<center>
<img src="pics/testbed_setup.jpg" width=500>
</center>
</p>

<p>
The complete testbed architecture consists of the wireless ad-hoc network
of nodes (router + mote), database server collecting motes' logs, and
web-based user interface. The wireless network of the testbed nodes is 
automatically setup with the ad-hoc OLSR routing protocol. The protocol
sets up the links between the routers and finds the routes outside of the network
through one of the routers connected to Internet. The database server
stores logging messages sent by motes. A mote can send a report over the serial
interface. The serial interface is connected through USB to the WiFi router.
Each router receives its mote's reports and sends them to database. 
The database stores logs which are either ASCII messages or sequences 
of hexadecimal numbers. The web-based user interface allows to reprogram
the system running on the motes and it allows to observe and collect 
logging messages. The testbed architecture is shown on the figure below. 
<center>
<img src="pics/testbed_blueprint.jpg" width=500>
</center>
</p>

<p>
All WiFi routers run OpenWRT with set of tools supporting communication
between the router and the motes. The two important tools are serial2file
and serial2mysql. The first one allows to read serial messages
arriving from motes over the USB and to store the messages in a file located on the router.
Further, the logs from a file are periodically pulled from a router and stored
in a database. The serial2mysql also collects serial messages, but instead of storing 
them in a local file, the program pushes the logs to a remote database mysql server.
More information about the tools can be found in section 
<a href='../openwrt/openwrt_packages.php'>OpenWRT->Packages</a>. 
The information about the tools' source code can be found
in section <a href='../openwrt/openwrt_source.php'>OpenWRT->Source</a>. 
</p>

<p>
Through the <a href='testbed_upload.php'>web-interface</a>
a user uploads a compiled image of a TinyOS/Fennec Fox system. After system
upload, the image is sent to all the WiFi routers in the network, which further
reprogram their attached motes to run the new firmware. Once reprogrammed,
the website sends back a report with the status of the routers and about
the results of reprogramming of every mote. At this moment all motes are running
the new version of the uploaded system, which may either report debugging
printf statements or send messages over the serial interface. The system cannot
send serial messages and printf statements simultaneously. The messages sent from
the motes are stored in a database and can be observed and downloaded
from the <a href='testbed_logs.php'>testbed logs site</a>.
</p>


<?php include("../footer.php"); ?>

