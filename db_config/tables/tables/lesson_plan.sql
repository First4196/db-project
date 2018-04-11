CREATE TABLE IF NOT EXISTS lesson_plan(
	curriculum_id VARCHAR(5) NOT NULL,
    course_id VARCHAR(7) NOT NULL,
    CONSTRAINT lesson_plan_pk PRIMARY KEY (curriculum_id,course_id),
    CONSTRAINT lesson_plan_fk1 FOREIGN KEY (course_id) REFERENCES course(course_id),
    CONSTRAINT lesson_plan_fk2 FOREIGN KEY (curriculum_id) REFERENCES curriculum(curriculum_id)
);
