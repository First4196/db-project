CREATE TABLE IF NOT EXISTS exam(
    exam_name VARCHAR(50) NOT NULL,
    CONSTRAINT course_sem_pk PRIMARY KEY (course_id, course_year, course_semester),
);
