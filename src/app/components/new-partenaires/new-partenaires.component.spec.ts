import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { NewPartenairesComponent } from './new-partenaires.component';

describe('NewPartenairesComponent', () => {
  let component: NewPartenairesComponent;
  let fixture: ComponentFixture<NewPartenairesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ NewPartenairesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(NewPartenairesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
