import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PagePartenaireComponent } from './page-partenaire.component';

describe('PagePartenaireComponent', () => {
  let component: PagePartenaireComponent;
  let fixture: ComponentFixture<PagePartenaireComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PagePartenaireComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PagePartenaireComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
