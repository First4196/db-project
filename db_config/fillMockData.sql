# Mock data (Please add real data soon)

INSERT INTO building 
(building_id,name_abbrev,faculty) 
VALUES 
('BD01','ENG3','21'),
('BD02','ENG4','21'),
('BD03','ICANTEEN','21');


INSERT INTO room
(room_no,building_id)
VALUES
('409','BD01'),
('LIB','BD01'),
('409','BD02'),
('19FLOOR','BD02'),
('CAFE_ROOM','BD03');


INSERT INTO class_arrangement
(course_id,course_year,course_semester,course_section,room_no,building_id,class_date,class_start_time,class_finish_time)
VALUES
(2109101,2017,2,1,'409','BD01',2,'8:00:00','9:30:00'),
(2109101,2017,2,1,'409','BD01',4,'8:00:00','9:30:00'),
(2109101,2017,2,1,'CAFE_ROOM','BD03',4,'11:00:00','13:00:00'),
(2110101,2017,2,1,'LIB','BD01',3,'8:00:00','16:00:00'),
(2110101,2017,2,2,'LIB','BD01',4,'8:00:00','16:00:00'),
(2110101,2017,2,3,'LIB','BD01',5,'8:00:00','16:00:00');


INSERT INTO teaching
(professor_id,course_id,course_year,course_semester,course_section)
VALUES
('athasit.s',2109101,2017,2,1),
('athasit.s',2110101,2017,2,1),
('athasit.s',2110101,2017,2,2),
('jaidee.r',2110101,2017,2,3);