CREATE TABLE IF NOT EXISTS course_sem(
    course_id VARCHAR(7) NOT NULL,
    course_year INTEGER(4) NOT NULL,
    course_semester INTEGER(1) NOT NULL,
    CONSTRAINT course_sem_pk PRIMARY KEY (course_id, course_year, course_semester),
    CONSTRAINT course_id_fk FOREIGN KEY (course_id) REFERENCES course(course_id)
);