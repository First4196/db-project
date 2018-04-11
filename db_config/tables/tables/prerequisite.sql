CREATE TABLE IF NOT EXISTS prerequisite(
	course VARCHAR(7) NOT NULL,
    precourse VARCHAR(7) NOT NULL,
    CONSTRAINT prerequisite_pk PRIMARY KEY(course,precourse),
    CONSTRAINT prerequisite_fk1 FOREIGN KEY (course) REFERENCES course(course_id),
    CONSTRAINT prerequisite_fk2 FOREIGN KEY (precourse) REFERENCES course(course_id)
);
