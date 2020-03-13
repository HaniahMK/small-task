from pypika import MySQLQuery, Table
import mysql.connector

#establish the connection to skills_db
skillsdb_connection= mysql.connector.connect(
host='localhost',
user="root",
database='skills_db',
passwd="")
  
skillsdb_cursor= skillsdb_connection.cursor()
 
# insert a new row in skill table 
def skill_insert(cleaned_text):
    skill_table= Table('skill')
    skill_columns= 'cleaned_text'
    insert_skill=MySQLQuery.into(skill_table).columns(skill_columns).insert(cleaned_text)
    skillsdb_cursor.execute((str(insert_skill)))
    print(insert_skill)
    return skillsdb_cursor.lastrowid
    
 #insert a new row in synonym table   
def synonym_insert(skill_id,synonym_text,is_original):
    synonym_table= Table('synonym')
    synonym_columns= ['skill_id`', '`synonym_text`', '`is_original']
    insert_synonym=MySQLQuery.into(synonym_table).columns( ",".join(synonym_columns)).insert(skill_id,synonym_text,is_original)
    skillsdb_cursor.execute(str(insert_synonym))
    print(insert_synonym)
    return skillsdb_cursor.lastrowid

# store a dictionary of keys as cleaned_text and values as synonym_text
def skills_dict_insert (skills_dict):

    for cleaned_text in skills_dict:
        skill_id= skill_insert(cleaned_text)
        #first synonym text is considered original text
        is_original=1
        for synonym_text in skills_dict[cleaned_text]:
            synonym_insert(skill_id,synonym_text,is_original)
            is_original=0

