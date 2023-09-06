from django import forms
from .models import Post, Category, Testimonial
from django_summernote.widgets import SummernoteWidget, SummernoteInplaceWidget


choices = Category.objects.all().values_list('name','name')
choice_list = []

for category in choices:
    choice_list.append(category)

class NewPostForm(forms.ModelForm):
    
    class Meta:
        model = Post
        fields = ("title", "category","intro", "body","price","image")
        widgets = {
            'title': forms.TextInput(attrs={'class': 'form-control'}),
            'intro': forms.TextInput(attrs={'class': 'form-control'}),
            'category': forms.Select(choices=choice_list, attrs={'class': 'form-control'}),
            'body':SummernoteInplaceWidget
        }
    

class FeedBackForm(forms.ModelForm):
    
    class Meta:
        model =  Testimonial
        fields = ("First_name","Last_name","Message","Image")
        widgets = {
            'Message': forms.Textarea(attrs={'rows':10, 'cols':5}),
        }

