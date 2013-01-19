New Validator

FieldType Abstract class
- value
- required
- setValue()
- getValue()
- isRequired()


# The reason for this is because different field have various ways to store data
# that should be handled differently, for instance inputs will always be set in POST 
# whereas checkboxes may/may not be set. We should be able to validate each by 
# using a factory to generate these FieldTypes, passing an instance of the ValidationMethods
# to them and they can validate themselves.

Children Classes 
- InputField 
- SelectField
- RadioField
- CheckboxField
- FileField
- FilesField
- TextAreaField


Factory will make these fields, ValidationMethods passed to the fields, they validate themselves
