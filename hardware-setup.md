Assembling the Weather Station Control Unit
===========================================

Mounting the Raspberry Pi
-------------------------

1.  To assemble the weather station, you will first need to mount the
    Raspberry Pi on to an acrylic base. You will need the following
    components and kit (see Appendix 1 for contents of bags).

    1.  Large acrylic base
    2.  Raspberry Pi 2
    3.  Weather Station HAT
    4.  CR1225 Coin Cell Battery
    5.  40 pin GPIO extender
    6.  4 x 8mm screws
    7.  4 x 6mm screws
    8.  4 x Hex spacers

    ![](file:images/Mounting_Kit.jpg)

2.  Place the Raspberry Pi onto the acrylic base plate as shown below.
    The power connector on the Raspberry Pi should be orientated to
    match the cut-out in the acrylic base.

    ![](images/Orientated_Pi.jpg)

3.  Feed an 8mm screw through the underside of the acrylic base and the
    Raspberry Pi, and secure with a hex spacer.

    ![](images/Secure_Pi.jpg)

4.  Repeat this step for the remaining screws and spacers.

    ![](images/Secured_Pi.jpg)

5.  Attach the 40 pin extender to the the Raspberry Pi

    ![](images/Attach_Extender.jpg)

6.  Take the Weather Station Hat and carefully snap it in two, along one
    of the scored lines.

    ![](images/Snap_WSH1.jpg)

7.  Use pliers to remove the remaining section of the HAT.

    ![](images/Snap_WSH2.jpg) ![](images/Two_Halves.jpg)

8.  Insert the coin cell battery with the positive side facing upwards
    into the HAT.

    ![](images/Coin_Cell.jpg)

9.  Attach the HAT to the Raspberry Pi.

    ![](images/Attach_Hat.jpg)

10.  Secure the hat using the 6mm screws.

    ![](images/Secure_Hat.jpg)

    You can connect a Keyboard, Monitor and Mouse, along with Power at this point and proceed to installing and configuring software, then return to this guide later when you are ready to finish assembling the Weather Station. Alternatively, you can continue working through this guide and proceed to the Software setup at a later time.

Providing Power and Network Connectivity.
-----------------------------------------

1.  The HAT provides power to the Raspberry Pi, via the GPIO pins. To
    power the Raspberry Pi, you will need the following parts.

    1.  Power over Ethernet (PoE) injector.
    2.  Power over Ethernet (PoE) splitter.
    3.  24V Transformer with international adaptors.
    4.  A CAT5 Ethernet cable, long enough to reach the area you wish to place
        the Weather Station. (**Not supplied--see the Ethernet cable grommet section below.**)

    ![](images/Power_Kit.jpg)

2.  Connect your keyboard, screen and mouse to your Raspberry Pi.

    ![](images/KVM.jpg)

3.  Connect the PoE splitter to the Pi and the HAT.

    ![](images/Splitter_Power.jpg) ![](images/Splitter_Eth.jpg)

4.  Connect the PoE splitter to the PoE injector using the CAT5 Ethernet
    cable.

    ![](images/Connect_Splitter.jpg)

5.  1.  Connect the PoE injector to the transformer, with the
        appropriate adaptor attached.

    ![](images/Power_Splitter.jpg)

6.  Plug in the power adaptor and Ethernet cable to check that the Pi is
    receiving power and connectivity.

    ![](images/Powered_Station.jpg)

Connecting the sensors
----------------------

The HAT has many sensors on the board, and several external sensors
which connect to it. More details on each sensor and how they work be
found on the following pages:

[Rain Gauge](rain-gauge.md), [Anemometer](anemometer.md), [Wind Vane](wind-vane.md) and [Temperature probe](temp-probe.md)

1.  There are three inputs on the Weather Station HAT, as shown in the
    image below.

    1.  The Rain Gauge will be plugged directly into the upper most RJ11
        socket.
    2.  The Anemometer / Wind Vain will be plugged directly into the
        middle RJ11 socket.
    3.  The Air Sensor needs assembling as detailed below.

Setting up the air sensor housing.
----------------------------------

1.  For this you will need:

    1.  4 x Plastic Fixing Screws
    2.  4 x Plastic Spacers
    3.  4 x Plastic Fixing Nuts
    4.  Small acrylic base
    5.  Small air sensor housing.
    6.  2 x Mounting Screws

    ![](images/Air_Kit.jpg)

2.  Align the air sensor board with the acrylic base as shown.

    ![](images/Align_Air.jpg)

3.  Using the plastic spacers to keep the board away from the acrylic
    base, fix it in place using the fixing screws and nuts.

    ![](images/Secure_Air.jpg)

4.  Mount the acrylic base into the housing as shown below.

    ![](images/Mount_Air.jpg)

5.  Remove two rubber seals, opposite the RJ11 sockets.

    ![](images/Remove_Plugs.jpg)

6.  Connect an RJ11 cables and the temperature probe to the air sensor
    module as shown below.

    ![](images/Connect_Air.jpg)

Assembling the Control Unit Housing
-----------------------------------

1.  Unpack the large grey case, and remove the 4 screws from inside and
    set them to one side. They are used for securing the lid at the end.

    ![](images/Main_Housing.jpg)

2.  For this stage you will need:

    1.  The large case
    2.  6 x 10mm screws
    3.  Your acrylic mounted Raspberry Pi and Weather HAT

    ![](images/Housing_Kit.jpg)

3.  Fix the acrylic base to the bottom of the case, using the 6 x 10mm
    screws

    ![](images/Fix_Base.jpg)

Water-proofing the Control Unit connections
--------------------------------------------

1.  Now you can attach the rain gauge. Remove the rubber seal from the
    side of the case.

    ![](images/Remove_Seal.jpg)

2.  Remove the 12mm plastic nut from the grommet on the rain gauge RJ11
    cable

    ![](images/Remove_Nut.jpg)

3.  Using the nut as a guide, mark the seal with a 10mm (approx) circle.

    ![](images/Draw_Circle.jpg) ![](images/Complete_Circle.jpg)

4.  Use a scalpel or sharp knife to cut a hole through the seal.

    ![](images/Cut_Circle.jpg)

5.  Push the end of the RJ11 cable through the seal.

    ![](images/Push_Through.jpg)

6.  Push the threaded end of the grommet through the seal, twisting
    might make this easier.

    ![](images/Twisting_Through.jpg)

7.  Feed the plastic nut back onto the RJ11 cable and thread it onto the
    grommet.

    ![](images/Plastic_Nut.jpg)

8.  Push the seal back into the case.

    ![](images/Fit_Seal.jpg)

9.  Repeat the previous steps for the wind vane.

10.  Connect the RJ11 cables to the Weather HAT.

    ![](images/Attach_RJ11.jpg)

11.  Tighten the outer end of the grommet so it grips the cable and forms
    a water-tight seal.

![](images/Fix_Grommit.jpg)

Air Sensor Grommet
-----------------------
Connect and seal the air sensor grommet as per the rain sensor instructions above.

Ethernet Cable Grommet
---------------------
The Ethernet (network) cable has been deliberately left out of the kit because we simply don't know how and where you will site your weather station: it may be close to router or it may be 50 metres away. There are two options for networking and sealing the weather station box: either use a ready-made Ethernet cable (known as a *patch cable*) or make your own.

### Making your own network cable

If you are able to make up your own network cable--or can get someone to do it for you--then this is best route. You can thread the smaller 16mm gland on to the cable before you crimp the network connector on to the cable. This way you will get the best seal and the length will also be perfect.

### Using a patch cable

The plastic connector of a patch cable is too big to go through the 16mm plastic sealing nut, as fitted to the rain and wind sensors. You will therefore have to use the larger 20mm sealing nut (gland). The size is marked "M20"on the collar. 

![](\images\gland.jpg) 

We tested a lot of cables and they all fitted through the 20mm gland with a bit of fiddling. You will have to take the gland apart first, as in the picture. In one case we had to trim the plastic of the network connector slightly with a knife. 

The downside is that the 20mm gland is too big to seal properly on the cable. You will need to seal it as best you can with tape or rubber grommets or ingenuity to keep the elements out. 

## Connecting the weather station to your network

After testing and installing your weather station it will need to be connected to your network. This is one area where it is very hard to give specific instructions--every school, organisation and home is different. As well as physical differences in how a computer connects there are  potential issues with firewalls, proxies and other restrictions. Our advice is:

- If you have a network/ICT technician at your school please get them involved in the project. 
- If you don't have a technician, find out who is responsible for your network and get them involved in the project.
- If you have questions or are stuck then visit our [Weather Station forum](https://www.raspberrypi.org/forums/viewforum.php?f=112).

Of course, if you *are* the ICT technician or network manager then we would love you to share your experience and knowledge on [the forums](https://www.raspberrypi.org/forums/viewforum.php?f=112).

## Finally...

We made the weather station as an educational *kit* on purpose, so that teachers and students could explore computing, sensors, networking, databases and, of course, problem solving.

If you get stuck or just want to share your experiences, [please come to the forums](https://www.raspberrypi.org/forums/viewforum.php?f=112) for a chat. Good luck and have fun!


----------


## Appendix 1. Parts list
The contents of the plastic bags in the free weather station kit are as follows:

**Board mounting kit packet**
- Plastic Fixing nuts, 4
- Plastic PCB spacers, 4
- Plastic fixing screws, 4
- CR1225 button battery
- 6mm steel screws, 4
- Receptacle (GPIO pin extender)
- Hex spacer, 4

**Enclosure kit packet**
- 10mm screws 8
- Sealing gland, M20mm x 1.5, 2
- Gland, M16x1.5, 1
- Sealing bushing (large), 2
- 25mm sealing bushing, 2

**External fixing kit packet**
- Brackets with screws, plastic, 4
- Screw covers
- Rubber washers, 4
- Self-tapping screws, 10

