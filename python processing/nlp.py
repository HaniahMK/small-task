# -*- coding: utf-8 -*-


import spacy
import pandas as pd
from collections import defaultdict


#excel file path
file_path='skills.xlsx'




#load french model
nlp= spacy.load('fr')

#load exeel file into data frame, sort and remove duplicates value
skills_df= pd.read_excel(file_path,index_column=0)
skills_df=skills_df.sort_values(by='Skills')
skills_df.drop_duplicates(keep = 'first', inplace = True) 


remove_stopwords_and_punctuation=( lambda text: 
                               " ".join(token.lemma_ for token in nlp(text) 
                                    if not token.is_stop and not token.is_punct) )
skills_dict=defaultdict(list)  

#loop through skill to remove stop words and punctuationn
for index,row in skills_df.iterrows():

 
    cleaned_text=remove_stopwords_and_punctuation(row['Skills'])
    skills_dict[cleaned_text].append(row['Skills'])
    
    
from pypika import MySQLQuery, Table
import mysql.connector

#connect to the database
skillsdb = mysql.connector.connect(
  host="localhost",
  user="root",
  database='skills_db',
  passwd=""
)
cursor =skillsdb.cursor()


#insert dict to database
skill_table= Table('skill')
description_table= Table('description')
#first loop to insert cleaned text (key)
#second loop to insert full text (value)
for key in skills_dict:
    query=MySQLQuery.into(skill_table).columns('cleaned_text').insert(key)
    cursor.execute(str(query))
    for value in skills_dict[key]:
        cleaned_text_id=cursor.lastrowid
        query=MySQLQuery.into(description_table).columns('skill_id','text').insert( cleaned_text_id,value)
        cursor.execute(str(query))


        
        
       
   


    

    
    
   
        


    
    


