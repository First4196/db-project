CREATE TABLE IF NOT EXISTS news(
    course_id VARCHAR(7) NOT NULL,
    course_year INTEGER(4) NOT NULL,
    course_semester INTEGER(1) NOT NULL,
    course_section INTEGER(2) NOT NULL,
    publish_time TIME NOT NULL,
	title VARCHAR(20),
    detail TEXT,
    CONSTRAINT news_pk PRIMARY KEY (course_id,course_year,course_semester,course_section,publish_time),
    CONSTRAINT news_fk FOREIGN KEY (course_id,course_year,course_semester,course_section) REFERENCES course_section(course_id,course_year,course_semester,course_section)
);
