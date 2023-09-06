from django import forms
from django.contrib.auth.forms import UserCreationForm, AuthenticationForm, UserChangeForm
from account.models import CustomUser as User


class RegisterForm(UserCreationForm):
    class Meta:
        model = User
        fields = ("first_name", "last_name", "telephone", "gender", "password1", "password2")
        widgets = {
            'first_name': forms.TextInput(attrs={'class': 'form-control'}),
            'last_name': forms.TextInput(attrs={'class': 'form-control'}),
            'telephone': forms.TextInput(attrs={'class': 'form-control'}),
            'gender': forms.Select(attrs={'class': 'form-control'}),
            
        }

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.fields['password1'].widget = forms.PasswordInput(
            attrs={'class': 'form-control'})
        self.fields['password2'].widget = forms.PasswordInput(
            attrs={'class': 'form-control'})
        self.fields['first_name'].widget.attrs.update(
            {'placeholder': 'Enter your first name'})
        self.fields['last_name'].widget.attrs.update({'placeholder': 'Enter your last name'})
        self.fields['telephone'].widget.attrs.update(
            {'placeholder': 'Enter phone number'})
        self.fields['password1'].widget.attrs.update(
                    {'placeholder': 'Enter your password'})
        self.fields['password2'].widget.attrs.update(
            {'placeholder': 'Confirm your password'})
        

    def save(self, commit=True):
        user = super().save(commit=False)
        user.first_name = self.cleaned_data["first_name"]
        user.last_name = self.cleaned_data["last_name"]
        user.telephone = self.cleaned_data["telephone"]
        user.gender = self.cleaned_data["gender"]
        user.is_author = True
        if commit:
            user.save()
        return user


class LoginForm(AuthenticationForm):
    username = forms.CharField(
        max_length=20, widget=forms.TextInput(attrs={'class': 'form-control'}))
    password = forms.CharField(
        widget=forms.PasswordInput(attrs={'class': 'form-control'}))

    class Meta:
        model = User
        fields = ('username', 'password')

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.fields['username'].widget.attrs.update(
            {'placeholder': 'Telephone'})
        self.fields['password'].widget.attrs.update(
            {'placeholder': 'Password'})

class UpdateUserProfile(UserChangeForm):
    first_name = forms.CharField(widget=forms.TextInput(attrs={'class': 'form-control', 'placeholder':"Enter your first name"})),
    last_name = forms.CharField(widget=forms.TextInput(attrs={'class': 'form-control', 'placeholder':"Enter your last name"})),
    telephone = forms.CharField(widget=forms.TextInput(attrs={'class': 'form-control', 'placeholder':"Enter your Telephone"})),
    gender = forms.CharField(widget=forms.Select(attrs={'class': 'form-control'})),
            
    class Meta:
        model = User
        fields = ["first_name", "last_name", "telephone", "gender"]
