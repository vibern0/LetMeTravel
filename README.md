# LetMeTravel
[![License][license-svg]][license-url]

An website and mobile app where is possible to buy bus tickets.

####How it works
Any client (registered or not) can buy a bus ticket. It's possible to buy trough web browser or mobile app.
If the client buy the ticket using the app, the ticket will be shown there. If bought on web site, the ticket will be sent to
e-mail, in pdf format.

####Administrator
The administrator can administrate the clients, bus lines, control ticket prices and other things.

####The backend system
To understand how it works it's just necessary to pay attention. Every station is considered a stop. So, initial and final stations are stops. If the bus stops in a station meanwhile the initial a final station, it's also considered a stop. So, when a client buy a new ticket, the ticket is registered with initial and final stop. Seats area available when there is no tickets on a station.

[license-svg]: https://img.shields.io/badge/license-GNU%20v.3-blue.svg
[license-url]: https://github.com/obernardovieira/LetMeTravel
