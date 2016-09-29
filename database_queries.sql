--This is just an example of the queries that will be needed to make a reservation between Porto and Lisboa. This examples are tested with some data already written in the database, by hand.

--get available destinations
SELECT DISTINCT st.name FROM stops s, stations st, trajects t,
(SELECT t.order AS o, t.id AS t_id FROM stops s, trajects t, stations st WHERE st.name = 'Porto' AND s.id_station = st.id AND t.id_stop = s.id) o
WHERE t.order >= o.o AND st.id = s.id_station AND s.id = t.id_stop AND t.id = o.t_id




--get available schedule
SELECT s.hour, s.minute FROM stops s, stations st, trajects t,
(SELECT t.order AS o, t.id AS t_id FROM stops s, trajects t, stations st WHERE st.name = 'Porto' AND s.id_station = st.id AND t.id_stop = s.id) s1,
(SELECT t.order AS o, t.id AS t_id FROM stops s, trajects t, stations st WHERE st.name = 'Lisboa' AND s.id_station = st.id AND t.id_stop = s.id) s2
WHERE s1.t_id = s2.t_id AND t.id = s1.t_id AND st.id = s.id_station AND s.id = t.id_stop AND st.name = 'Porto'



--get leave and arrive time (to calculate price)
SELECT s1.h, s1.m, s2.h, s2.m FROM
(SELECT s.hour AS h, s.minute AS m, t.id AS t FROM stops s, trajects t, stations st WHERE st.name = 'Porto' AND s.id_station = st.id AND t.id_stop = s.id) s1,
(SELECT s.hour AS h, s.minute AS m, t.id AS t FROM stops s, trajects t, stations st WHERE st.name = 'Lisboa' AND s.id_station = st.id AND t.id_stop = s.id) s2
WHERE s1.t = s2.t LIMIT 1



--select traject according to station from, station to and schedule
SELECT tr.id FROM stops s, stations st, trajects t, transports tr,
(SELECT t.order AS o, t.id AS t_id FROM stops s, trajects t, stations st WHERE st.name = 'Porto' AND s.id_station = st.id AND t.id_stop = s.id) s1,
(SELECT t.order AS o, t.id AS t_id FROM stops s, trajects t, stations st WHERE st.name = 'Lisboa' AND s.id_station = st.id AND t.id_stop = s.id) s2
WHERE s1.t_id = s2.t_id AND t.id = s1.t_id AND st.id = s.id_station AND s.id = t.id_stop AND st.name = 'Porto' AND s.hour = 10 AND s.minute = 0 AND t.id = tr.id_traject



--buy ticket

--(get number os seats)
SELECT number FROM transports WHERE id = 1

--(get used seats)
SELECT seat FROM tickets WHERE id_transport = 1 AND id_stop_from = 2 AND id_stop_to = 4

--(now make a new reservation!)


