/*********************************************************************/
/*                                                                   */
/* create_dimensional_database.sql                                   */
/* Create Hotel Reservation Data Warehouse 2008/08/08 by Ono         */
/* Modify date changes                                               */
/*********************************************************************/

# Step 1. Create Data Warehouse Database and Tables

DROP DATABASE IF EXISTS hoteldw;
CREATE DATABASE IF NOT EXISTS hoteldw;
USE hoteldw;

CREATE TABLE customer_dim 
( customer_sk INT NOT NULL AUTO_INCREMENT PRIMARY KEY
, customer_number INT
, customer_name CHAR(50)
, customer_gender CHAR(10)
, customer_address CHAR(50)
, customer_city CHAR(30)
, customer_state CHAR(30)
, customer_country CHAR(30)
, effective_date DATE
, expiry_date DATE );

CREATE TABLE hotel_dim 
( hotel_sk INT NOT NULL AUTO_INCREMENT PRIMARY KEY
, hotel_code INT
, hotel_name CHAR(30)
, hotel_area CHAR(30)
, hotel_rank CHAR(10)
, effective_date DATE
, expiry_date DATE );

CREATE TABLE order_dim 
( order_sk INT NOT NULL AUTO_INCREMENT PRIMARY KEY
, order_number INT
, effective_date DATE
, expiry_date DATE );

CREATE TABLE date_dim 
( date_sk INT NOT NULL AUTO_INCREMENT PRIMARY KEY
, date DATE
, month_name CHAR(9)
, month INT(1)
, quarter INT(1)
, year INT(4)
, effective_date DATE
, expiry_date DATE );

CREATE TABLE sales_order_fact 
( order_sk INT 
, customer_sk INT 
, hotel_sk INT
, order_date_sk INT
, sales_unit DECIMAL(10,2)
, sales_amount DECIMAL(10,2) );

CREATE TABLE sales_order_stg 
( order_number INT 
, customer_number INT 
, hotel_code INT
, room_type INT
, order_date DATE
, entry_date DATE
, sales_unit DECIMAL(10,2)
, sales_amount DECIMAL(10,2) );


# Step 2. Pre-populate Date Dimension
\. C:\dw\hoteldw\pre_populate_date.sql
USE hoteldw;
CALL pre_populate_date('2016-01-01', '2018-12-31');
SELECT count(*) FROM date_dim;

show tables;

# Please proceed to ETL process.

