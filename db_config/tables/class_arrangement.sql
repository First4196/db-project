CREATE TABLE IF NOT EXISTS class_arrangement(
    course_id VARCHAR(7) NOT NULL,
    course_year INTEGER(4) UNSIGNED NOT NULL,
    course_semester INTEGER(1) UNSIGNED NOT NULL,
    course_section INTEGER(2) UNSIGNED NOT NULL,
    room_no VARCHAR(10) NOT NULL,
    building_id CHAR(4) NOT NULL,
    class_date INTEGER(1) UNSIGNED NOT NULL, # 1-Sunday, 2-Monday, ..., 7-Saturdat (follow datofweek in mysql)
    class_start_time TIME NOT NULL,
    class_finish_time TIME NOT NULL,
    CONSTRAINT class_arr_pk PRIMARY KEY (course_id,course_year,course_semester,course_section,
		room_no,building_id, class_date, class_start_time),
    CONSTRAINT class_arr_fk1 FOREIGN KEY (course_id,course_year,course_semester,course_section)
    REFERENCES course_section(course_id,course_year,course_semester,course_section),
    CONSTRAINT class_arr_fk2 FOREIGN KEY (room_no, building_id) REFERENCES room(room_no, building_id),
	CONSTRAINT class_days_of_week CHECK(class_date BETWEEN 1 AND 7),
	CONSTRAINT class_time_duration CHECK(class_start_time < class_finish_time)
);
