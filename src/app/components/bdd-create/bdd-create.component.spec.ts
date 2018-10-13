import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BddCreateComponent } from './bdd-create.component';

describe('BddCreateComponent', () => {
  let component: BddCreateComponent;
  let fixture: ComponentFixture<BddCreateComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BddCreateComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BddCreateComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
