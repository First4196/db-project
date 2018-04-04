CREATE TABLE IF NOT EXISTS class_arrangement(
    course_id VARCHAR(7) NOT NULL,
    course_year INTEGER(4) NOT NULL,
    course_semester INTEGER(1) NOT NULL,
    course_section INTEGER(2) NOT NULL,
    room_no INTEGER(5) NOT NULL,
	building_id INTEGER(3) NOT NULL,
    class_date INTEGER(1) NOT NULL, # 1-Sunday, 2-Monday, ..., 7-Saturdat (follow datofweek in mysql)
    class_start_time TIME NOT NULL,
    class_finish_time TIME NOT NULL,
    CONSTRAINT class_arr_pk PRIMARY KEY (course_id,course_year,course_semester,course_section,
		room_no,building_id, class_date, class_start_time),
    CONSTRAINT class_arr_fk1 FOREIGN KEY (course_id,course_year,course_semester,course_section)
    REFERENCES course_section(course_id,course_year,course_semester,course_section),
    CONSTRAINT class_arr_fk2 FOREIGN KEY (room_no, building_id) REFERENCES room(room_no, building_id)
);
