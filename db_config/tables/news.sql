CREATE TABLE IF NOT EXISTS news(
    news_id INTEGER(5) NOT NULL,
    course_id VARCHAR(7) NOT NULL,
    course_year INTEGER(4) NOT NULL,
    course_semester INTEGER(1) NOT NULL,
    course_section INTEGER(2) NOT NULL,
    title VARCHAR(20),
    detail TEXT,
    publish_time TIME,
    CONSTRAINT news_pk PRIMARY KEY (news_id,course_id,course_year,course_semester,course_section),
    CONSTRAINT news_fk FOREIGN KEY (course_id,course_year,course_semester,course_section)
    REFERENCES course_section(course_id,course_year,course_semester,course_section)
);
