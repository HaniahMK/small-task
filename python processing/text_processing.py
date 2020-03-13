import spacy

nlp= spacy.load('fr')

def remove_stopwords(text):
    return " ".join(token.lemma_ for token in nlp(text) 
                                    if not token.is_stop)
def remove_punct(text):
    return " ".join(token.lemma_ for token in nlp(text) 
                                    if not token.is_punct)

