CREATE TABLE IF NOT EXISTS exam_arrangement(
    	room_no INTEGER(5) NOT NULL,
    	building_id INTEGER(3) NOT NULL,
	exam_name VARCHAR(50) NOT NULL,
	exam_date DATE,
	start_time TIME,
	finish_time TIME,
    	CONSTRAINT exam_pk PRIMARY KEY (room_no,building_id,exam_name,exam_date,start_time),
    	CONSTRAINT exam_fk1 FOREIGN KEY (exam_name) REFERENCES exam(exam_name),
    	CONSTRAINT exam_fk2 FOREIGN KEY (room_no,building_id) REFERENCES room(room_no,building_id)
);
