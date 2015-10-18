# /usr/bin/python

import re
import codecs

filename = 'scheme.txt'


def loadInputFile(filename):
	file = codecs.open(filename,'r','utf-8')
	return file
def getLines(file):
	lines = file.read().split('\n')
	return lines
def getClassname(s):
	s = s.split("(");
	return s[0][:-1]
def getFields(s):
	attributes = list()
	for field in getRawFields(s):
		field = field[0].lower() + field[1:]
		if field[-1] == ")":
			field = field[:-1]
		attributes.append("private $"+field+";")
	return attributes
def getGetters(s):
	fields = getRawFields(s)
	getters = list()
	for field in fields:
		getter = "public function get"+field+"(){ return $this->"+field[0].lower() + field[1:]+";}"
		getters.append(getter)
	return getters
def getSetters(s):
	fields = getRawFields(s)
	setters = list()
	for field in fields:
		setter = "public function set"+field+"($"+field[0].lower() + field[1:]+"){ $this->"+field[0].lower() + field[1:]+" = $"+field[0].lower() + field[1:]+";}"
		setters.append(setter)
	return setters

def getRawFields(s):
	s = s.split("(")
	fields = s[1].split(",")
	rawFields = list()
	for field in fields:
		field = field.strip()
		field = field.strip(")")
		rawFields.append(field)
	return rawFields
def getNameSpace(namespace):
	return "namespace "+namespace+";"
def getClassString(s):
	classString = "<?php"
	classString += "\n"
	classString += getNameSpace("CookingAssist\Model")
	classString += "\n"
	classString += "\n"
	classString += "\n"
	classString += "class "+getClassname(s)
	classString += "\n{\n"
	for field in getFields(s):
		classString += "\t"
		classString += field
		classString += "\n"
	classString += "\n"
	for getter in getGetters(s):
		classString += "\t"
		classString += getter
		classString += "\n"
	classString += "\n"
	for setter in getSetters(s):
		classString += "\t"
		classString += setter
		classString += "\n"
	classString += "}"
	
	return classString


for line in getLines(loadInputFile(filename)):
	if len(line)>0:
		classname = getClassname(line)
		outputName = classname+".php"

		outFile = codecs.open(outputName,'w','utf-8')
		outFile.write(getClassString(line))
		outFile.close()






