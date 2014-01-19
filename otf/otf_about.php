<?php include("../info.php"); ?>

<SCRIPT LANGUAGE="JavaScript">
<!-- Begin
if (location.href.indexOf("http://github.com/mszczodrak/otf/wiki") == -1){
  window.setTimeout('window.location="http://github.com/mszczodrak/otf/wiki"; ',0);
}
// End -->
</SCRIPT>


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

<h2>Open Testbed Framework</h2>

<p>
The Open Testbed Framework (OTF) consists of a set of tools 
for rapid deployment of a Low-Power Wireless Network (LPWN) testbeds.
The LPWN is the underlying communication architecture for systems
monitoring environment, such as Wireless Sensor Networks (WSN), and
systems interacting with the surrounding environment through
sensors and actuators, referred to as Cyber-Physical Systems (CPS).
</p>

<p>
While developing one of these, either CPS or WSN, one programs small,
battery-powered embedded devices that are called motes. The picture below
shows examples of four different motes: Z1, TelosB, ez430-rf2500, and Intel mote2.
</p>

<center>
<img src="pics/motes.jpg" width=500>
</center>

<p>
In theory, one can purchase a set of motes, program them and deploy.
Once deployed, the motes would create an ad-hoc mesh network and start
collecting sensor measurements and control actuators. 
In practise, however, setting up LPWN is not plug-and-play. First, one
needs to write embedded program for each mote. Many versions of the code
are written, compiled and deployed on a mote before the one successful version
of the program runs as expected. Second, there are many knobs to be tuned
in both WSN and CPS applications. For example, one may not know 
how frequently a sensors should be sampled, or how much delay is
acceptable when sending signal to an actuator. These, often deployment
and application specific values are known after multiple 
runs of experiments with all the motes running a program testing
a new idea of the system configuration.
The bottom line is, it takes hundreds and probably even thousands 
of iterations of reprogramming motes, debugging, and collecting 
data that helps understand how LPWN operates.
</p>

<p>
As with other software developments, programming WSN or CPS applications comes down to 
continues debugging and testing. 
On one hand, this may not differ much from developing any piece of software:
one writes many versions of the code, compiles, tests, and improves before
the expected software behavior is observed. 
On the other hand, developing is more tricky: every program runs not on one device but on multiple devices.
Because each device must be reconfigured separately to run another test or experiment,
deploying new software across the hardware becomes the major productivity bottleneck.
To improve development of applications running on LPWN one needs tools that
would automate network reconfiguration and support software debugging and design.
Such tools allow to setup a testbed for WSN and CPS systems development.
</p>

<p>
The Open Testbed Framework provides tools supporting development of
embedded programs running on LPWN. 
The framework consists of a server providing user interface to deploy
and debug a network of motes. The server also stores logging messages
collected from the motes. 
The framework sets up a testbed backbone network 
communication among all the motes.
Through the backbone network, the framework allows to reconfigure
firmware running on all the motes and to collect debugging messages sent
by a program running across the motes.
</p>

<center>
<img src="pics/testbed_blueprint.jpg" width=500>
</center>

<p>
The figure above shows the architecture of the Open Testbed Framework.
The framework runs a web-based user interface that allows developers
to remotely upload an image of a new firmware into the framework
and to collect logs and debugging messages stored in the database
that is also part of the framework. The database stores testbed
configuration information and collects log messages send from the motes.
The framework backbone network is implemented through an ad-hoc mesh of
WiFi routers. Each WiFi router runs embedded OpenWrt Linux with tools
allowing motes' firmware reconfiguration and with tools collecting 
logging messages from motes. At least one WiFi router must be connected
to Ethernet or other network that can access the framework's server.
</p>

<center>
<img src="pics/testbed_setup.jpg" width=500>
</center>

<p>
The Open Testbed Framework consists of multiple modes. As shown on picture
above, each node is build of one mote and one WiFi router, connected together
through USB. Because each mote is attached to a router, every mote
can be individually reprogrammed and monitored. This approach also allows
to quickly redeploy the nodes, add more nodes with more motes or to split
one testbed deployment into to separate testbeds.
</p>

<p>
<b>
To find more information on how to setup a testbed using
the Open Testbed Framework, go to the 
<a href="otf_tutorial.php">testbed tutorial</a>.
</b>
</p>


<?php include("../footer.php"); ?>

