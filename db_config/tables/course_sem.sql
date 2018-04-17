DROP TABLE course_sem;

CREATE TABLE IF NOT EXISTS course_sem(
    course_id VARCHAR(7) NOT NULL,
    course_year INTEGER(4) UNSIGNED NOT NULL,
    course_semester INTEGER(1) UNSIGNED NOT NULL,
    leader VARCHAR(30),
    midterm_exam VARCHAR(50),
    final_exam VARCHAR(50),
    CONSTRAINT course_sem_pk PRIMARY KEY (course_id, course_year, course_semester),
    CONSTRAINT course_sem_fk1 FOREIGN KEY (course_id) REFERENCES course(course_id),
    CONSTRAINT course_sem_fk2 FOREIGN KEY (leader) REFERENCES professor(professor_id),
    CONSTRAINT course_sem_fk3 FOREIGN KEY (midterm_exam) REFERENCES exam(exam_name),
    CONSTRAINT course_sem_fk4 FOREIGN KEY (final_exam) REFERENCES exam(exam_name),
    CONSTRAINT course_sem_year CHECK(start_year >= 1899 AND start_year <= YEAR(CURDATE())+1),
    CONSTRAINT course_sem_sem CHECK(course_semester > 0 AND course_semester <= 3)
);
