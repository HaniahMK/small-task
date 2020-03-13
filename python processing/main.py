import pandas as pd
from collections import defaultdict
import text_processing 
import skills_db

#excel file path
file_path='skills.xlsx'

#load exeel file into data frame, sort and remove duplicates value
skills_df= pd.read_excel(file_path,index_column=0)
skills_df=skills_df.sort_values(by='Skills')
skills_df.drop_duplicates(keep = 'first', inplace = True) 

#skills_dict cleaned_text is the key, synonym_texts are the value 
skills_dict=defaultdict(list)  


#iterate through dataframe rows 
#remove stop words
#remove punct
for index,row in skills_df.iterrows():
 
    cleaned_text=text_processing.remove_stopwords(row['Skills'])
    cleaned_text=text_processing.remove_punct(cleaned_text)
    skills_dict[cleaned_text].append(row['Skills'])
    

#store the dictionary in the database
skills_db.skills_dict_insert(skills_dict)
