--
-- PostgreSQL database dump
--

\restrict T6lXW5fZnHeEQOoan8SP7JeIc2x69p11lUvf5tZRJx2CsUeaML8HSDZpNxc4dTy

-- Dumped from database version 16.12
-- Dumped by pg_dump version 16.12

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: gym_mang_system_v1; Type: DATABASE; Schema: -; Owner: -
--

CREATE DATABASE gym_mang_system_v1 WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'C';


\unrestrict T6lXW5fZnHeEQOoan8SP7JeIc2x69p11lUvf5tZRJx2CsUeaML8HSDZpNxc4dTy
\connect gym_mang_system_v1
\restrict T6lXW5fZnHeEQOoan8SP7JeIc2x69p11lUvf5tZRJx2CsUeaML8HSDZpNxc4dTy

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: admin; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.admin (
    admin_id integer NOT NULL,
    admin_name character varying(20),
    admin_email character varying(20),
    admin_age integer,
    admin_gender character varying(6),
    admin_pass character varying(10),
    acontact_no bigint,
    admin_add text,
    admin_fname character varying(10),
    admin_lname character varying(10),
    admin_city character varying(10)
);


--
-- Name: admin_admin_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.admin_admin_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: admin_admin_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.admin_admin_id_seq OWNED BY public.admin.admin_id;


--
-- Name: batch; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.batch (
    batch_id integer NOT NULL,
    batch_time character varying(50),
    user_fname character varying(10),
    user_lname character varying(10),
    user_age integer,
    user_gender character varying(6)
);


--
-- Name: batch_batch_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.batch_batch_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: batch_batch_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.batch_batch_id_seq OWNED BY public.batch.batch_id;


--
-- Name: bills; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.bills (
    bill_id integer NOT NULL,
    user_name character varying(10),
    user_email character varying(30),
    user_age integer,
    user_gender character varying(6),
    contact_no bigint,
    user_add text,
    user_fname character varying(10),
    user_lname character varying(10),
    user_city character varying(10),
    joindate character varying(50),
    expirydate character varying(50),
    fees character varying(50)
);


--
-- Name: bills_bill_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.bills_bill_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: bills_bill_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.bills_bill_id_seq OWNED BY public.bills.bill_id;


--
-- Name: dietplan; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.dietplan (
    dietplan_id integer NOT NULL,
    diet_time character varying(50),
    diet_meal text,
    diet_food text
);


--
-- Name: dietplan_dietplan_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.dietplan_dietplan_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: dietplan_dietplan_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.dietplan_dietplan_id_seq OWNED BY public.dietplan.dietplan_id;


--
-- Name: equipment; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.equipment (
    eq_id integer NOT NULL,
    eq_name character varying(20),
    eq_img bytea,
    eq_info text
);


--
-- Name: equipment_eq_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.equipment_eq_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: equipment_eq_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.equipment_eq_id_seq OWNED BY public.equipment.eq_id;


--
-- Name: fees_transaction; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.fees_transaction (
    id integer NOT NULL,
    mid integer,
    paid integer,
    submitdate date,
    transaction_remark character varying(40)
);


--
-- Name: fees_transaction_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.fees_transaction_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: fees_transaction_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.fees_transaction_id_seq OWNED BY public.fees_transaction.id;


--
-- Name: member; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.member (
    mid integer NOT NULL,
    emailid character varying(40),
    mname character varying(30),
    joindate date,
    tname character varying(30),
    contact character varying(30),
    fees integer,
    batch character varying(30),
    delete_status integer
);


--
-- Name: member_mid_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.member_mid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: member_mid_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.member_mid_seq OWNED BY public.member.mid;


--
-- Name: student; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.student (
    rno integer NOT NULL,
    sname character varying(20)
);


--
-- Name: student_rno_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.student_rno_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: student_rno_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.student_rno_seq OWNED BY public.student.rno;


--
-- Name: trainers; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.trainers (
    trainer_id integer NOT NULL,
    trainer_name character varying(10),
    trainer_email character varying(20),
    trainer_age integer,
    trainer_gender character varying(6),
    trainer_pass character varying(10),
    tcontact_no bigint,
    trainer_add text,
    trainer_fname character varying(10),
    trainer_lname character varying(10),
    trainer_city character varying(10)
);


--
-- Name: trainers_trainer_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.trainers_trainer_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: trainers_trainer_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.trainers_trainer_id_seq OWNED BY public.trainers.trainer_id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    name character varying(120) NOT NULL,
    username character varying(120) NOT NULL,
    password character varying(255) NOT NULL
);


--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.users (
    user_id integer NOT NULL,
    user_name character varying(10),
    user_pass character varying(10),
    user_email character varying(30),
    user_age integer,
    user_gender character varying(6),
    contact_no bigint,
    user_add text,
    user_fname character varying(10),
    user_lname character varying(10),
    user_city character varying(10)
);


--
-- Name: user_user_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.user_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: user_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.user_user_id_seq OWNED BY public.users.user_id;


--
-- Name: admin admin_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin ALTER COLUMN admin_id SET DEFAULT nextval('public.admin_admin_id_seq'::regclass);


--
-- Name: batch batch_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.batch ALTER COLUMN batch_id SET DEFAULT nextval('public.batch_batch_id_seq'::regclass);


--
-- Name: bills bill_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bills ALTER COLUMN bill_id SET DEFAULT nextval('public.bills_bill_id_seq'::regclass);


--
-- Name: dietplan dietplan_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.dietplan ALTER COLUMN dietplan_id SET DEFAULT nextval('public.dietplan_dietplan_id_seq'::regclass);


--
-- Name: equipment eq_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipment ALTER COLUMN eq_id SET DEFAULT nextval('public.equipment_eq_id_seq'::regclass);


--
-- Name: fees_transaction id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fees_transaction ALTER COLUMN id SET DEFAULT nextval('public.fees_transaction_id_seq'::regclass);


--
-- Name: member mid; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.member ALTER COLUMN mid SET DEFAULT nextval('public.member_mid_seq'::regclass);


--
-- Name: student rno; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.student ALTER COLUMN rno SET DEFAULT nextval('public.student_rno_seq'::regclass);


--
-- Name: trainers trainer_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.trainers ALTER COLUMN trainer_id SET DEFAULT nextval('public.trainers_trainer_id_seq'::regclass);


--
-- Name: user id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- Name: users user_id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users ALTER COLUMN user_id SET DEFAULT nextval('public.user_user_id_seq'::regclass);


--
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.admin (admin_id, admin_name, admin_email, admin_age, admin_gender, admin_pass, acontact_no, admin_add, admin_fname, admin_lname, admin_city) FROM stdin;
1	dhanashree	dhanashree@gmail.com	20	female	12345	987654321	malegaon	\N	\N	\N
2	a	a@gmail.com	33	female	12345	123456789	m	\N	\N	\N
3	a	a@gmail.com	33	female	12345	98765431	a	\N	\N	\N
4	a	a@gmail.com	22	female	12345	987654321	malegaon	\N	\N	\N
5	teenaPawar	teena@gmail.com	21	female	12345	123456789	jvfj fkuc yuwe chjcjhejfb	\N	\N	\N
6	a	a@gmail.com	1	female	12345	987654321	malegaon	a	a	malegaon
7	a	a@gmail.com	1	female	12345	987654321	malegaon	a	a	malegaon
8	ruchika	ruchika@gmail.com	30	female	12345	987654321	malegaon	ruchika	shete	malegaon
9	prasad	prasad@gmail.com	22	male	12345	8967452321	indraprastha colony , malegaon	prasad	pawar	male
10	prasad	prasad@gmail.com	22	male	12345	8967452321	indraprastha colony , malegaon	prasad	pawar	male
11	prasad	prasad@gmail.com	22	male	12345	8967452321	indraprastha colony , malegaon	prasad	pawar	male
12	prasad	prasad@gmail.com	22	male	12345	8967452321	indraprastha colony , malegaon	prasad	pawar	male
13	pratiksha	pratiksha@gmail.com	20	female	12345	987654321	malegaon	pratiksha	pawar	malegaon
\.


--
-- Data for Name: batch; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.batch (batch_id, batch_time, user_fname, user_lname, user_age, user_gender) FROM stdin;
1	08.00am	tina	patil	20	female
2	09.00am	rakesh	deore	25	male
3	08.00am	mina	patil	21	female
4	09.00am	krushna	bachhav	47	male
\.


--
-- Data for Name: bills; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.bills (bill_id, user_name, user_email, user_age, user_gender, contact_no, user_add, user_fname, user_lname, user_city, joindate, expirydate, fees) FROM stdin;
1	ruchika	ruchika@gmail.com	20	female	987654321	malegaon	ruchika	shete	malegaon	24/4/2023	\N	\N
2	ruchika	ruchika@gmail.com	20	female	987654321	malegaon	ruchika	shete	malegaon	24/4/2023	\N	\N
3	pratiksha	pratiksha@gmail.com	20	female	987654321	melagaon	pratiksha	pawar	melagaon	24/4/2023		\N
4	dhanashree	dhanashree@gmail.com	20	female	987654321	malegaon	dhanashree	vadnere	malegaon	24/4/2023	24/5/2023	500
5	mansipawar	mansi@gmail.com	21	female	987654321	malegaon	mansi	pawar	malegaon	24/4/2023	24/5/2023	500
6	mansipawar	mansi@gmail.com	21	female	987654321	malegaon	mansi	pawar	malegaon	24/4/2023	24/5/2023	500
7	pratiksha	pratiksha@gmail.com	20	female	987654321	malegaon	pratiksha	pawar	malegaon	24/4/2023	24/5/2023	500
8	pratiksha	pratiksha@gmail.com	20	female	123456789	malegaon	pratiksha	pawar	malegaon	24/4/2023	24/5/2023	500
9	pratiksha	pratiksha@gmail.com	20	female	987654321	malegaon	pratiksha	pawar	malegaon	24/4/2023	24/5/2023	1000
10	mansipatil	mansipatil@gmail.com	20	female	9876543210	malegaon	mansi	patil	malegaon	24/4/2023	25/5/2023	500
11	neha	nehapatil@gmail.com	20	female	9823456765	Jayram nagar,suryvanshi lawns malegaon	neha	patil	malegaon	24/05/2023	25/5/2023	1000
\.


--
-- Data for Name: dietplan; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.dietplan (dietplan_id, diet_time, diet_meal, diet_food) FROM stdin;
1	8.00 AM-9.00 AM	breakfast 	Oat Meal Porridge+ 4 egg White
2	11.00 AM 12.00 PM	Mid Morning 	Papaya(1 Bowl)
3	2.00 PM- 3.00PM	Lunch 	2 Roti+Brown Rice (Half Bowl)Pulse(Dal) /Chicken/Fish/ Seasonalvegetables Low Fat Curd Sprouts +veg Salad
4	5.00 PM-6.00PM	Evening Snacks	Green Tea With ALmonds
5	8.00PM-9.00PM	Dinner	Seasonal Vegetables Sprouts+veg Salad
6	10.00PM	Bed Time	Toned Milk
\.


--
-- Data for Name: equipment; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.equipment (eq_id, eq_name, eq_img, eq_info) FROM stdin;
1	treadmill	\\x612e6a7067	Motor: AC 4.0 HP\n\tspeed: 1.0-20km/hr\n\trunning area: 163*58cm (64"x23")\n\tincline: 20 Level\n\tDisplay:18.5" LED Screen\n\tDisplay Reading:Time,Speed,Incline,Heart Rate,Distance and Calories
2	treadmill	\\x612e6a7067	Motor: AC 4.0 HP\n\tspeed: 1.0-20km/hr\n\trunning area: 163*58cm (64"x23")\n\tincline: 20 Level\n\tDisplay:18.5" LED Screen\n\tDisplay Reading:Time,Speed,Incline,Heart Rate,Distance and Calories
3	dumble	\\x632e6a7067	Brand:HEXA fitness\n\tColor:Black\n\tItem Weight:5 Kilograms \n\tMaterial:Rubber\n\tSpecial Feature:No Roll Head\n\tProduct Dimension:25Lx20W Centimeters
4	dumble	\\x632e6a7067	Brand:HEXA fitness\n\tColor:Black\n\tItem Weight:5 Kilograms \n\tMaterial:Rubber\n\tSpecial Feature:No Roll Head\n\tProduct Dimension:25Lx20W Centimeters
5	bench press	\\x642e6a7067	Brand:Kore\n\tItem Weight:14000 Grams\n\tMaterial:Other\n\tColour:Black\n\tProduct Dimensions:42Dx85Wx15H Centimeters\n\tWeight Limit:250 Kilograms
6	bench press	\\x642e6a7067	Brand:Kore\n\tItem Weight:14000 Grams\n\tMaterial:Other\n\tColour:Black\n\tProduct Dimensions:42Dx85Wx15H Centimeters\n\tWeight Limit:250 Kilograms
7	Leg Extension	\\x652e6a7067	Brand:Zorex\n\tItem Weight:23 Kilograms\n\tMaterial:Faux Leather\n\tColour:Black\n\tProduct Dimensions:115D x 47W x 40H Centimeters\n\tFrame Material:Heavy-duty Frame
8	Leg Extension	\\x652e6a7067	Brand:Zorex\n\tItem Weight:23 Kilograms\n\tMaterial:Faux Leather\n\tColour:Black\n\tProduct Dimensions:115D x 47W x 40H Centimeters\n\tFrame Material:Heavy-duty Frame
9	Kettlebell	\\x662e6a7067	Weight:5000 Grams\n\tBrand:Amazon Brand -Symactive\n\tColour:red\n\tMaterial:Cast Iron\n\tItem Dimensions:30.5x25.4x12.7 LxWxH cm
10	Kettlebell	\\x662e6a7067	Weight:5000 Grams\n\tBrand:Amazon Brand -Symactive\n\tColour:red\n\tMaterial:Cast Iron\n\tItem Dimensions:30.5x25.4x12.7 LxWxH cm
\.


--
-- Data for Name: fees_transaction; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.fees_transaction (id, mid, paid, submitdate, transaction_remark) FROM stdin;
\.


--
-- Data for Name: member; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.member (mid, emailid, mname, joindate, tname, contact, fees, batch, delete_status) FROM stdin;
\.


--
-- Data for Name: student; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.student (rno, sname) FROM stdin;
1	Pratiksha
\.


--
-- Data for Name: trainers; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.trainers (trainer_id, trainer_name, trainer_email, trainer_age, trainer_gender, trainer_pass, tcontact_no, trainer_add, trainer_fname, trainer_lname, trainer_city) FROM stdin;
1	ruchika	ruchika@gmail.com	30	female	12345	987654321	malegaon	\N	\N	\N
2	mansi	mansi@gmail.com	20	female	12345	987654321	malegaon	mansi	pawar	malegaon
3	pratiksha	pratikshai@gmail.com	20	female	12345	987654321	malegaon	pratiksha	pawar	malegaon
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public."user" (id, name, username, password) FROM stdin;
1	a a	a	827ccb0eea8a706c4c34a16891f84e7b
2	dhanashree	dhanashree	827ccb0eea8a706c4c34a16891f84e7b
3	prasad pawar	prasad	827ccb0eea8a706c4c34a16891f84e7b
4	pratiksha pawar	pratiksha	827ccb0eea8a706c4c34a16891f84e7b
5	ruchika shete	ruchika	827ccb0eea8a706c4c34a16891f84e7b
6	teenaPawar	teenaPawar	827ccb0eea8a706c4c34a16891f84e7b
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

COPY public.users (user_id, user_name, user_pass, user_email, user_age, user_gender, contact_no, user_add, user_fname, user_lname, user_city) FROM stdin;
1	tina	12345	tina@gmail.com	30	female	987654321	malegaon	\N	\N	\N
2	tina	12345	tina@gmail.com	6	female	987654321	malegaon	\N	\N	\N
3	mina	12345	mina@gmail.com	30	female	987654321	malegaon	\N	\N	\N
4	tina	12345	tina@gmail.com	1	female	987654321	malegaon		\N	\N
5	tina	12345	tina@gmail.com	1	female	987654321	malegaon	tina	\N	\N
6	a	1	a@gmail.com	3	female	1	1	a	a	\N
7	a	12345	a@gmail.com	33	male	98765431	a	a	a	
8	a	12345	a@gmail.com	1	female	987654321	987654321	a	a	malegaon
9	a	12345	a@gmail.com	22	female	987654321	malegaon	a	a	malegaon
10	a	12345	a@gmail.com	30	female	987654321	malegaon	a	a	malegaon
11	b	qwerty	m@gmail.com	4	male	34214	d	b	b	d
12	pratiksha	12345	pratiksha@gmail.com	20	female	987654321	malegaon	pratiksha	pawar	malegaon
13	krushna	12345	krushna@gmail.com	47	male	987654321	malegaon	krushna	bachhav	malegaon
14	Mohit	123456	mohit@gmail.com	20	male	9876543211	malegoan	Mohit	Pawar	malegoan
15	rahul	12345	rahuldeore@gmail.con	30	male	9345678976	malegaon	rahul	deore	malegaon
16	rakesh	12345	rakesh@gmail.com	30	male	987654321	indraprastha colony , malegaon	rakesh	pawar	malegaon
17	mansipawar	12345	mansi@gmail.com	21	female	987654321	malegaon	mansi	pawar	malegaon
18	mansipatil	12345	mansipatil@gmail.com	20	female	9876543210	malegaon	mansi	patil	malegaon
\.


--
-- Name: admin_admin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.admin_admin_id_seq', 13, true);


--
-- Name: batch_batch_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.batch_batch_id_seq', 1, false);


--
-- Name: bills_bill_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.bills_bill_id_seq', 11, true);


--
-- Name: dietplan_dietplan_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.dietplan_dietplan_id_seq', 1, false);


--
-- Name: equipment_eq_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.equipment_eq_id_seq', 1, false);


--
-- Name: fees_transaction_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.fees_transaction_id_seq', 1, false);


--
-- Name: member_mid_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.member_mid_seq', 1, false);


--
-- Name: student_rno_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.student_rno_seq', 1, false);


--
-- Name: trainers_trainer_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.trainers_trainer_id_seq', 3, true);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.user_id_seq', 6, true);


--
-- Name: user_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.user_user_id_seq', 18, true);


--
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (admin_id);


--
-- Name: batch batch_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.batch
    ADD CONSTRAINT batch_pkey PRIMARY KEY (batch_id);


--
-- Name: bills bills_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.bills
    ADD CONSTRAINT bills_pkey PRIMARY KEY (bill_id);


--
-- Name: dietplan dietplan_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.dietplan
    ADD CONSTRAINT dietplan_pkey PRIMARY KEY (dietplan_id);


--
-- Name: equipment equipment_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.equipment
    ADD CONSTRAINT equipment_pkey PRIMARY KEY (eq_id);


--
-- Name: fees_transaction fees_transaction_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.fees_transaction
    ADD CONSTRAINT fees_transaction_pkey PRIMARY KEY (id);


--
-- Name: member member_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.member
    ADD CONSTRAINT member_pkey PRIMARY KEY (mid);


--
-- Name: student student_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.student
    ADD CONSTRAINT student_pkey PRIMARY KEY (rno);


--
-- Name: trainers trainers_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.trainers
    ADD CONSTRAINT trainers_pkey PRIMARY KEY (trainer_id);


--
-- Name: users user_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT user_pkey PRIMARY KEY (user_id);


--
-- Name: user user_pkey1; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey1 PRIMARY KEY (id);


--
-- Name: user user_username_key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_username_key UNIQUE (username);


--
-- PostgreSQL database dump complete
--

\unrestrict T6lXW5fZnHeEQOoan8SP7JeIc2x69p11lUvf5tZRJx2CsUeaML8HSDZpNxc4dTy

