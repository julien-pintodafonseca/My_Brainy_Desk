import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/Forms';
import { AppRoutingModule } from './app-routing.module';
import { NgxSmartModalModule } from 'ngx-smart-modal';
import { HttpClientModule } from '@angular/common/http';

import { AppComponent } from './app.component';
import { HomeComponent } from './components/home/home.component';
import { PageNotFoundComponent } from './components/page-not-found/page-not-found.component';
import { RegistrationComponent } from './components/registration/registration.component';
import { EditProfileComponent } from  './components/edit-Profile/edit-Profile.component';
import { ForgottenPasswordComponent } from  './components/forgotten-password/forgotten-password.component';
import { BddCreateComponent } from './components/bdd-create/bdd-create.component';

import { BddCreateService } from './services/bdd-create.service';

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    PageNotFoundComponent,
    RegistrationComponent,
    EditProfileComponent,
    ForgottenPasswordComponent,
    BddCreateComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    AppRoutingModule,
    NgxSmartModalModule.forRoot(),
    HttpClientModule
  ],
  providers: [
    BddCreateService
  ],
  bootstrap: [
    AppComponent
  ]
})

export class AppModule {

}
