--
-- PostgreSQL database dump
--

-- Dumped from database version 14.8 (Ubuntu 14.8-0ubuntu0.22.04.1)
-- Dumped by pg_dump version 14.2

-- Started on 2023-07-16 19:41:04

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
-- TOC entry 4 (class 2615 OID 24640)
-- Name: workana_store; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA workana_store;


ALTER SCHEMA workana_store OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 209 (class 1259 OID 24641)
-- Name: customers; Type: TABLE; Schema: workana_store; Owner: postgres
--

CREATE TABLE workana_store.customers (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL
);


ALTER TABLE workana_store.customers OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 24646)
-- Name: customers_id_seq; Type: SEQUENCE; Schema: workana_store; Owner: postgres
--

CREATE SEQUENCE workana_store.customers_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE workana_store.customers_id_seq OWNER TO postgres;

--
-- TOC entry 3366 (class 0 OID 0)
-- Dependencies: 210
-- Name: customers_id_seq; Type: SEQUENCE OWNED BY; Schema: workana_store; Owner: postgres
--

ALTER SEQUENCE workana_store.customers_id_seq OWNED BY workana_store.customers.id;


--
-- TOC entry 211 (class 1259 OID 24647)
-- Name: order_items; Type: TABLE; Schema: workana_store; Owner: postgres
--

CREATE TABLE workana_store.order_items (
    id integer NOT NULL,
    order_id integer NOT NULL,
    product_id integer NOT NULL,
    quantity integer NOT NULL,
    item_price numeric(10,2) NOT NULL,
    item_tax numeric(10,2) NOT NULL
);


ALTER TABLE workana_store.order_items OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 24650)
-- Name: order_items_id_seq; Type: SEQUENCE; Schema: workana_store; Owner: postgres
--

CREATE SEQUENCE workana_store.order_items_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE workana_store.order_items_id_seq OWNER TO postgres;

--
-- TOC entry 3367 (class 0 OID 0)
-- Dependencies: 212
-- Name: order_items_id_seq; Type: SEQUENCE OWNED BY; Schema: workana_store; Owner: postgres
--

ALTER SEQUENCE workana_store.order_items_id_seq OWNED BY workana_store.order_items.id;


--
-- TOC entry 213 (class 1259 OID 24651)
-- Name: orders; Type: TABLE; Schema: workana_store; Owner: postgres
--

CREATE TABLE workana_store.orders (
    id integer NOT NULL,
    customer_id integer NOT NULL,
    total numeric(10,2) DEFAULT 0.00 NOT NULL,
    total_tax numeric(10,2) DEFAULT 0.00 NOT NULL
);


ALTER TABLE workana_store.orders OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 24656)
-- Name: orders_id_seq; Type: SEQUENCE; Schema: workana_store; Owner: postgres
--

CREATE SEQUENCE workana_store.orders_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE workana_store.orders_id_seq OWNER TO postgres;

--
-- TOC entry 3368 (class 0 OID 0)
-- Dependencies: 214
-- Name: orders_id_seq; Type: SEQUENCE OWNED BY; Schema: workana_store; Owner: postgres
--

ALTER SEQUENCE workana_store.orders_id_seq OWNED BY workana_store.orders.id;


--
-- TOC entry 215 (class 1259 OID 24657)
-- Name: product_types; Type: TABLE; Schema: workana_store; Owner: postgres
--

CREATE TABLE workana_store.product_types (
    id integer NOT NULL,
    description character varying(255) NOT NULL,
    tax_rate numeric(5,2) NOT NULL
);


ALTER TABLE workana_store.product_types OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 24660)
-- Name: product_types_id_seq; Type: SEQUENCE; Schema: workana_store; Owner: postgres
--

CREATE SEQUENCE workana_store.product_types_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE workana_store.product_types_id_seq OWNER TO postgres;

--
-- TOC entry 3369 (class 0 OID 0)
-- Dependencies: 216
-- Name: product_types_id_seq; Type: SEQUENCE OWNED BY; Schema: workana_store; Owner: postgres
--

ALTER SEQUENCE workana_store.product_types_id_seq OWNED BY workana_store.product_types.id;


--
-- TOC entry 217 (class 1259 OID 24661)
-- Name: products; Type: TABLE; Schema: workana_store; Owner: postgres
--

CREATE TABLE workana_store.products (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    price numeric(10,2) NOT NULL,
    product_type_id integer NOT NULL
);


ALTER TABLE workana_store.products OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 24664)
-- Name: products_id_seq; Type: SEQUENCE; Schema: workana_store; Owner: postgres
--

CREATE SEQUENCE workana_store.products_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE workana_store.products_id_seq OWNER TO postgres;

--
-- TOC entry 3370 (class 0 OID 0)
-- Dependencies: 218
-- Name: products_id_seq; Type: SEQUENCE OWNED BY; Schema: workana_store; Owner: postgres
--

ALTER SEQUENCE workana_store.products_id_seq OWNED BY workana_store.products.id;


--
-- TOC entry 3189 (class 2604 OID 24665)
-- Name: customers id; Type: DEFAULT; Schema: workana_store; Owner: postgres
--

ALTER TABLE ONLY workana_store.customers ALTER COLUMN id SET DEFAULT nextval('workana_store.customers_id_seq'::regclass);


--
-- TOC entry 3190 (class 2604 OID 24666)
-- Name: order_items id; Type: DEFAULT; Schema: workana_store; Owner: postgres
--

ALTER TABLE ONLY workana_store.order_items ALTER COLUMN id SET DEFAULT nextval('workana_store.order_items_id_seq'::regclass);


--
-- TOC entry 3193 (class 2604 OID 24667)
-- Name: orders id; Type: DEFAULT; Schema: workana_store; Owner: postgres
--

ALTER TABLE ONLY workana_store.orders ALTER COLUMN id SET DEFAULT nextval('workana_store.orders_id_seq'::regclass);


--
-- TOC entry 3194 (class 2604 OID 24668)
-- Name: product_types id; Type: DEFAULT; Schema: workana_store; Owner: postgres
--

ALTER TABLE ONLY workana_store.product_types ALTER COLUMN id SET DEFAULT nextval('workana_store.product_types_id_seq'::regclass);


--
-- TOC entry 3195 (class 2604 OID 24669)
-- Name: products id; Type: DEFAULT; Schema: workana_store; Owner: postgres
--

ALTER TABLE ONLY workana_store.products ALTER COLUMN id SET DEFAULT nextval('workana_store.products_id_seq'::regclass);


--
-- TOC entry 3351 (class 0 OID 24641)
-- Dependencies: 209
-- Data for Name: customers; Type: TABLE DATA; Schema: workana_store; Owner: postgres
--

COPY workana_store.customers (id, name, email) FROM stdin;
1	STARLIGHT	starlight@vought.com
\.


--
-- TOC entry 3353 (class 0 OID 24647)
-- Dependencies: 211
-- Data for Name: order_items; Type: TABLE DATA; Schema: workana_store; Owner: postgres
--

COPY workana_store.order_items (id, order_id, product_id, quantity, item_price, item_tax) FROM stdin;
14	23	1	1	13.37	1.34
\.


--
-- TOC entry 3355 (class 0 OID 24651)
-- Dependencies: 213
-- Data for Name: orders; Type: TABLE DATA; Schema: workana_store; Owner: postgres
--

COPY workana_store.orders (id, customer_id, total, total_tax) FROM stdin;
23	1	13.37	1.34
\.


--
-- TOC entry 3357 (class 0 OID 24657)
-- Dependencies: 215
-- Data for Name: product_types; Type: TABLE DATA; Schema: workana_store; Owner: postgres
--

COPY workana_store.product_types (id, description, tax_rate) FROM stdin;
1	HOLSEHOLD	10.00
2	ELECTRONICS	10.00
\.


--
-- TOC entry 3359 (class 0 OID 24661)
-- Dependencies: 217
-- Data for Name: products; Type: TABLE DATA; Schema: workana_store; Owner: postgres
--

COPY workana_store.products (id, name, price, product_type_id) FROM stdin;
1	HAMMER	13.37	1
2	BALL	10.00	1
16	TOY	11.50	2
\.


--
-- TOC entry 3371 (class 0 OID 0)
-- Dependencies: 210
-- Name: customers_id_seq; Type: SEQUENCE SET; Schema: workana_store; Owner: postgres
--

SELECT pg_catalog.setval('workana_store.customers_id_seq', 1, true);


--
-- TOC entry 3372 (class 0 OID 0)
-- Dependencies: 212
-- Name: order_items_id_seq; Type: SEQUENCE SET; Schema: workana_store; Owner: postgres
--

SELECT pg_catalog.setval('workana_store.order_items_id_seq', 16, true);


--
-- TOC entry 3373 (class 0 OID 0)
-- Dependencies: 214
-- Name: orders_id_seq; Type: SEQUENCE SET; Schema: workana_store; Owner: postgres
--

SELECT pg_catalog.setval('workana_store.orders_id_seq', 25, true);


--
-- TOC entry 3374 (class 0 OID 0)
-- Dependencies: 216
-- Name: product_types_id_seq; Type: SEQUENCE SET; Schema: workana_store; Owner: postgres
--

SELECT pg_catalog.setval('workana_store.product_types_id_seq', 5, true);


--
-- TOC entry 3375 (class 0 OID 0)
-- Dependencies: 218
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: workana_store; Owner: postgres
--

SELECT pg_catalog.setval('workana_store.products_id_seq', 17, true);


--
-- TOC entry 3197 (class 2606 OID 24671)
-- Name: customers customers_email_key; Type: CONSTRAINT; Schema: workana_store; Owner: postgres
--

ALTER TABLE ONLY workana_store.customers
    ADD CONSTRAINT customers_email_key UNIQUE (email);


--
-- TOC entry 3199 (class 2606 OID 24673)
-- Name: customers customers_pkey; Type: CONSTRAINT; Schema: workana_store; Owner: postgres
--

ALTER TABLE ONLY workana_store.customers
    ADD CONSTRAINT customers_pkey PRIMARY KEY (id);


--
-- TOC entry 3201 (class 2606 OID 24675)
-- Name: order_items order_items_pkey; Type: CONSTRAINT; Schema: workana_store; Owner: postgres
--

ALTER TABLE ONLY workana_store.order_items
    ADD CONSTRAINT order_items_pkey PRIMARY KEY (id);


--
-- TOC entry 3203 (class 2606 OID 24677)
-- Name: orders orders_pkey; Type: CONSTRAINT; Schema: workana_store; Owner: postgres
--

ALTER TABLE ONLY workana_store.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (id);


--
-- TOC entry 3205 (class 2606 OID 24679)
-- Name: product_types product_types_pkey; Type: CONSTRAINT; Schema: workana_store; Owner: postgres
--

ALTER TABLE ONLY workana_store.product_types
    ADD CONSTRAINT product_types_pkey PRIMARY KEY (id);


--
-- TOC entry 3207 (class 2606 OID 24681)
-- Name: products products_pkey; Type: CONSTRAINT; Schema: workana_store; Owner: postgres
--

ALTER TABLE ONLY workana_store.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- TOC entry 3208 (class 2606 OID 24682)
-- Name: order_items order_items_order_id_fkey; Type: FK CONSTRAINT; Schema: workana_store; Owner: postgres
--

ALTER TABLE ONLY workana_store.order_items
    ADD CONSTRAINT order_items_order_id_fkey FOREIGN KEY (order_id) REFERENCES workana_store.orders(id);


--
-- TOC entry 3209 (class 2606 OID 24687)
-- Name: order_items order_items_product_id_fkey; Type: FK CONSTRAINT; Schema: workana_store; Owner: postgres
--

ALTER TABLE ONLY workana_store.order_items
    ADD CONSTRAINT order_items_product_id_fkey FOREIGN KEY (product_id) REFERENCES workana_store.products(id);


--
-- TOC entry 3210 (class 2606 OID 24692)
-- Name: orders orders_customer_id_fkey; Type: FK CONSTRAINT; Schema: workana_store; Owner: postgres
--

ALTER TABLE ONLY workana_store.orders
    ADD CONSTRAINT orders_customer_id_fkey FOREIGN KEY (customer_id) REFERENCES workana_store.customers(id);


--
-- TOC entry 3211 (class 2606 OID 24697)
-- Name: products products_product_type_id_fkey; Type: FK CONSTRAINT; Schema: workana_store; Owner: postgres
--

ALTER TABLE ONLY workana_store.products
    ADD CONSTRAINT products_product_type_id_fkey FOREIGN KEY (product_type_id) REFERENCES workana_store.product_types(id);


-- Completed on 2023-07-16 19:41:06

--
-- PostgreSQL database dump complete
--

