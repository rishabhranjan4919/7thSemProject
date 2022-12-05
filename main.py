import pickle
import regressor as regressor
import spacy
import sys

model_path="en_core_web_sm/en_core_web_sm/en_core_web_sm-3.4.1"


def predictSimiliarity(studentAnswer, sourceAnswer):
    nlp = spacy.load(model_path)
    obj1 = nlp(studentAnswer)
    obj2 = nlp(sourceAnswer)
    return obj1.similarity(obj2)

# pickle.dump(regressor, open('model.pkl','wb'))
teacherAnswer = sys.argv[1]
studentAnswer = sys.argv[2]
a = predictSimiliarity(studentAnswer, teacherAnswer)
percentage = str(round(a*100)) + '%'
print(percentage)
print(teacherAnswer)
print(studentAnswer)