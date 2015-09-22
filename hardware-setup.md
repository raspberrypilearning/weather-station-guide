Assembling the Weather Station Control Unit
===========================================

Mounting the Raspberry Pi
-------------------------

1.  To assemble the weather station, you will first need to mount the
    Raspberry Pi on to an acrylic base. You will need the following
    components and kit.

    1.  Large acrylic base
    2.  Raspberry Pi 2
    3.  Weather Station HAT
    4.  CR1225 Coin Cell Battery
    5.  40 pin GPIO extender
    6.  4 x 8mm screws
    7.  4 x 6mm screws
    8.  4 x Hex spacers

![](file:images/Mounting_Kit.jpg)

1.  Place the Raspberry Pi onto the acrylic base plate as shown below.
    The power connector on the Raspberry Pi should be orientated to
    match the cut-out in the acrylic base.

![](images/Orientated_Pi.jpg)

1.  Feed an 8mm screw through the underside of the acrylic base and the
    Raspberry Pi, and secure with a hex spacer.

![](images/Secure_Pi.jpg)

1.  Repeat this step for the remaining screws and spacers.

![](images/Secured_Pi.jpg)

1.  Attach the 40 pin extender to the the Raspberry Pi

![](images/Attach_Extender.jpg)

1.  Take the Weather Station Hat and carefully snap it in two, along one
    of the scored lines.

![](images/Snap_WSH1.jpg)

1.  Use pliers to remove the remaining section of the HAT.

![](images/Snap_WSH2.jpg) ![](images/Two_Halves.jpg)

1.  Insert the coin cell battery with the positive side facing upwards
    into the HAT.

![](images/Coin_Cell.jpg)

1.  Attach the HAT to the Raspberry Pi.

![](images/Attach_Hat.jpg)

1.  Secure the hat using the 6mm screws.

![](images/Secure_Hat.jpg)

    You can connect a Keyboard, Monitor and Mouse, along with Power at this point and proceed to installing and configuring software, then return to this guide later when you are ready to finish assembling the Weather Station. Alternatively, you can continue working through this guide and proceed to the Software setup at a later time.

Providing Power and Network Connectivity.
-----------------------------------------

1.  The HAT provides power to the Raspberry Pi, via the GPIO pins. To
    power the Raspberry Pi, you will need the following parts.

    1.  Power over Ethernet (PoE) injector.
    2.  Power over Ethernet (PoE) splitter.
    3.  24V Transformer with international adaptors.
    4.  A CAT5 cable, long enough to reach the area you wish to place
        the Weather Station. (**Not Supplied**)

![](images/Power_Kit.jpg)

1.  Connect your keyboard, screen and mouse to your Raspberry Pi.

![](images/KVM.jpg)

1.  Connect the PoE splitter to the Pi and the HAT.

![](images/Splitter_Power.jpg) ![](images/Splitter_Eth.jpg)

1.  Connect the PoE splitter to the PoE injector using the CAT5 Ethernet
    cable.

![](images/Connect_Splitter.jpg)

1.  1.  Connect the PoE injector to the transformer, with the
        appropriate adaptor attached.

![](images/Power_Splitter.jpg)

1.  Plugin the power adaptor and Ethernet cable to check that the Pi is
    receiving power and connectivity.

![](images/Powered_Station.jpg)

Connecting the sensors
----------------------

The HAT has many sensors on the board, and several external sensors
which connect to it. Details on each sensor and how to assemble can be
found on the following pages:

[Rain Gauge]() [Anemometer and Wind Vain]() [Temperature probe]()

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

1.  Align the air sensor board with the acrylic base as shown.

![](images/Align_Air.jpg)

1.  Using the plastic spacers to keep the board away from the acrylic
    base, fix it in place using the fixing screws and nuts.

![](images/Secure_Air.jpg)

1.  Mount the acrylic base into the housing as shown below.

![](images/Mount_Air.jpg)

1.  Remove two rubber seals, opposite the RJ11 sockets.

![](images/Remove_Plugs.jpg)

1.  Connect an RJ11 cables and the temperature probe to the air sensor
    module as shown below.

![](images/Connect_Air.jpg)

Assembling the Control Unit Housing
-----------------------------------

1.  Unpack the large grey case, and remove the 4 screws from inside and
    set them to one side. They are used for securing the lid at the end.

![](images/Main_Housing.jpg)

1.  For this stage you will need:

    1.  The large case
    2.  6 x 10mm screws
    3.  Your acrylic mounted Raspberry Pi and Weather HAT

![](images/Housing_Kit.jpg)

1.  Fix the acrylic base to the bottom of the case, using the 6 x 10mm
    screws

![](images/Fix_Base.jpg)

Water-proofing the Control Unit connections.
--------------------------------------------

1.  Now you can attach the rain gauge. Remove the rubber seal from the
    side of the case.

![](images/Remove_Seal.jpg)

1.  Remove the 12mm plastic nut from the grommet on the rain gauge RJ11
    cable

![](images/Remove_Nut.jpg)

1.  Using the nut as a guide, mark the seal with a 10mm (approx) circle.

![](images/Draw_Circle.jpg) ![](images/Complete_Circle.jpg)

1.  Use a scalpel or sharp knife to cut a hole through the seal.

![](images/Cut_Circle.jpg)

1.  Push the end of the RJ11 cable through the seal.

![](images/Push_Through.jpg)

1.  Push the threaded end of the grommet through the seal, twisting
    might make this easier.

![](images/Twisting_Through.jpg)

1.  Feed the plastic nut back onto the RJ11 cable and thread it onto the
    grommet.

![](images/Plastic_Nut.jpg)

1.  Push the seal back into the case.

![](images/Fit_Seal.jpg)

1.  Repeat the previous steps for the wind vain.

2.  Connect the RJ11 cables to the Weather HAT.

![](images/Attach_RJ11.jpg)

1.  Tighten the outer end of the grommet so it grips the cable and forms
    a water-tight seal.

![](images/Fix_Grommit.jpg)

TODO Air Sensor Grommet
-----------------------

TODO Ethernet Grommet
---------------------

TODO Attaching Lid and Feet
---------------------------

TODO Placement
--------------
