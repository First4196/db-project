CREATE TABLE IF NOT EXISTS exam(
	course_id VARCHAR(7) NOT NULL,
	course_year INTEGER(4) NOT NULL,
    	course_semester INTEGER(1) NOT NULL,
    	room_no INTEGER(5) NOT NULL,
    	building_id INTEGER(3) NOT NULL,
	exam_name VARCHAR(50) NOT NULL,
	exam_date DATE,
	start_time TIME,
	finish_time TIME,
    	CONSTRAINT exam_pk PRIMARY KEY (course_id,course_year,course_semester,room_no,building_id,exam_name),
    	CONSTRAINT exam_fk1 FOREIGN KEY (course_id,course_year,course_semester) REFERENCES course_sem(course_id,course_year,course_semester),
    	CONSTRAINT exam_fk2 FOREIGN KEY (room_no,building_id) REFERENCES room(room_no,building_id)
);
