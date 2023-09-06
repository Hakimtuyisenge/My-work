from django.contrib.auth.views import LogoutView
from .forms import LoginForm
from django.contrib.auth.views import LoginView

from django.urls import reverse_lazy
from django.views.generic import CreateView
from account.forms import RegisterForm

# Sign Up View
class RegisterView(CreateView):
    form_class = RegisterForm
    success_url = reverse_lazy('login')
    template_name = 'admin/signup.html'


class LoginView(LoginView):
    form_class = LoginForm
    template_name = 'admin/login.html'
    success_url = 'home'

class LogoutView(LogoutView):
    next_page = 'login'
