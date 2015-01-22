var ContactBox = React.createClass({
  loadContactsFromServer: function() {
    $.ajax({
      url: this.props.url.concat('?load'),
      dataType: 'json',
      success: function(data) {
		if (!Array.isArray(data))
			this.setState({errorMessage: 'Load failed'});
		else if (data.length == 0)
			this.setState({errorMessage: 'No contacts or load failed'});
		else if (data[0].hasOwnProperty('contactid') && data[0].hasOwnProperty('contactName'))
			this.setState({contacts: data, errorMessage: ''});
		else
			this.setState({errorMessage: 'Load failed'});
      }.bind(this),
      error: function(xhr, status, err) {
        console.error(this.props.url.concat('?load'), status, err.toString());
      }.bind(this)
    });
  },
  componentDidMount: function() {
    this.loadContactsFromServer();
  },
  handleContactSubmit: function(contact) {
	 $.ajax({
        url: this.props.url.concat('?add'),
        dataType: 'json',
        type: 'POST',
        data: contact,
        success: function(data) {
			if (Number.isInteger(data) && data>0) {
				contact.contactid = data ;
				var contacts = this.state.contacts;
				contacts.push(contact);
				contacts.sort(function(a,b) { return a.contactName.localeCompare(b.contactName) } );
				this.setState({contacts: contacts, contact: {contactName: ''}, edit: false});
			}
			else {
				this.setState({errorMessage: 'Insert failed'});
			}
        }.bind(this),
        error: function(xhr, status, err) {
          console.error(this.props.url.concat('?add'), status, err.toString());
        }.bind(this)
      });
	

  },
  deleteContact: function(contactid) {
	$.ajax({
		url: this.props.url.concat('?del='+contactid),
		dataType: 'json',
		type: 'POST',
		data: contactid,
		success: function(data) {
			if (data < 1) {
				this.setState({errorMessage: 'Contact not deleted'});
			}
			else {
				var contacts = this.state.contacts;
				
				for(var i = contacts.length - 1; i >= 0; i--) {
					if(contacts[i].contactid == contactid) {
					   contacts.splice(i, 1);
					   break;
					}
				}
				this.setState({contacts: contacts});
			}
		}.bind(this),
		error: function(xhr, status, err) {
		 console.error('Contact not deleted');
		}.bind(this)
		 });

  },
  editContact: function(contact) {
  this.deleteContact(contact.contactid);
  this.setState({edit: true, contact: contact});
  },
  handleContactNameChange: function(contactName) {
    var contact = this.state.contact ;
	contact.contactName = contactName ;
    this.setState({contact: contact});
  },
  handleEditCancel: function() {
    this.setState({edit: false, contact: {contactName: ''}, errorMessage: ''});
  },
  handleContactNameSubmit: function() {
    this.setState({edit: true});
  },
  getInitialState: function() {
    return {edit: false, contacts: [], contact: {contactName: ''}, errorMessage: ''};
  },

  render: function() {
  var that = this ;
	var theForm ;
	if (this.state.edit)
		theForm = <ContactEdit url="actions.php?add" contact={this.state.contact} errorMessage={this.state.errorMessage} onContactSubmit={this.handleContactSubmit} onContactNameChange={this.handleContactNameChange} onEditCancel={this.handleEditCancel} /> ;
	else
		theForm = <ContactSearch errorMessage={this.state.errorMessage} onContactNameSubmit={this.handleContactNameSubmit} onContactNameChange={this.handleContactNameChange} /> ;
	
    return (
	
		<div>
		{theForm}
        <ContactList contacts={this.state.contacts} contact={this.state.contact} deleteContact={that.deleteContact} editContact={that.editContact} />
		</div>
    );
  }
});

/*this.deleteContact*/

var ContactList = React.createClass({

  handleCommentSubmit: function(contactid) {
  this.props.deleteContact(contactid) ;
	return;

  },
  editContact: function(contact) {

  this.props.editContact(contact) ;
	return;

  },
  render: function() {
	var that = this;
	var contactName = this.props.contact.contactName.trim().toLowerCase();
	
	if(contactName.length > 0){
		list = this.props.contacts.filter(function(l){
			return l.contactName.toLowerCase().match( contactName );
		});
	}
	else {
		list = this.props.contacts;
	}
    var contactNodes = list.map(function(a,b,c,d,e) {
	  
      return (
        <Contact contact={a} key={b} deleteeContact={that.handleCommentSubmit} editContact={that.editContact} />
      );
    });
    return (
      <div id="contactList">
	  <div>
        {contactNodes}
		<div className="clearer"/>
		</div>
      </div>
    );
  }
});

var FormMixin = {
  handleContactNameChange: function(e){
	e.preventDefault();
	this.props.onContactNameChange(this.refs.contactName.getDOMNode().value);
		return;
  },
  componentWillReceiveProps: function(nextProps) {
	  this.setState({errorMessage: nextProps.errorMessage});
  }
};

var Contact = React.createClass({
  deleteMe: function() {
	this.props.deleteeContact(this.props.contact.contactid);
	return;
  },
  editMe: function() {
	this.props.editContact(this.props.contact);
	return;
  },
  render: function() {
	var that = this ;
  var hash = 0, i, chr, len;
  for (i = 0, len = this.props.contact.contactName.length; i < len; i++)
    hash  = (hash+this.props.contact.contactName.charCodeAt(i)*7)% 256;
	
  var styleDiv = {backgroundColor: 'hsl(' + hash % 256 + ', 30%, 85%)'};
  var styleButton = {color: 'hsl(' + hash % 256 + ', 30%, 85%)'};


		var phone = '',email = '',address = '',note = '';
		if (this.props.contact.phone.length > 0) 
			phone = <li className="note"><i className="fa fa-phone fa-1x" />{this.props.contact.phone}</li>;
		if (this.props.contact.email.length > 0) 
			email = <li className="note"><i className="fa fa-envelope fa-1x" />{this.props.contact.email}</li>;
		if (this.props.contact.address.length > 0) 
			address = <li className="note"><i className="fa fa-home fa-1x" />{this.props.contact.address}</li>;
		if (this.props.contact.note.length > 0) 
			note = <li className="note"><i className="fa fa-pencil fa-1x" />{this.props.contact.note}</li>;
	
    return (
      <div className="contact" style={styleDiv} >
	  <button className="pure-button delete" style={styleButton} onClick={that.deleteMe} tabIndex="-1"><i className="fa fa-times fa-2x"/></button>
	  <button className="pure-button edit" style={styleButton} onClick={that.editMe} tabIndex="-1"><i className="fa fa-pencil-square-o fa-2x"/></button>
        <h2 className="contactName">
          {this.props.contact.contactName}
        </h2>
		<ul>
		{phone}
		{email}
		{address}
		{note}
		</ul>
	   </div>
    );
  }
});

var ContactEdit = React.createClass({
   handleValueChange: function() {
	var contact = this.state.contact;
	contact.contactName = this.refs.contactName.getDOMNode().value;
	contact.phone = this.refs.phone.getDOMNode().value;
	contact.email = this.refs.email.getDOMNode().value;
	contact.address = this.refs.address.getDOMNode().value;
	contact.note = this.refs.note.getDOMNode().value;
    this.setState({contact: contact});
	return;
  },
  mixins: [FormMixin],
  handleSubmit: function(e) {
	e.preventDefault();
	this.handleValueChange() ;
    
	
    if (!this.state.contact.contactName) {
		this.setState({errorMessage: 'Fill the name'});
		return;
	}
	else if (!this.state.contact.phone && !this.state.contact.email && !this.state.contact.address && !this.state.contact.note) {
		this.setState({errorMessage: 'Fill at least one field'});
		return;
    }
	else {
		this.props.onContactSubmit(this.state.contact);
		return;
	}
  },
  handleEditCancel: function(e) {
	e.preventDefault();
    this.props.onEditCancel();
    return;
  },
  getInitialState: function() {
    return {contact: {}, errorMessage: this.props.errorMessage};
  },
  componentDidMount: function() {
    this.setState({contact: this.props.contact});
	this.refs.phone.getDOMNode().focus();
  },
  render: function() {

	that = this ;
    return (

      <form id="contactEdit" className="pure-form" onSubmit={this.handleSubmit}>
	  <fieldset>
	  
	    <div>
		 <div className="pure-u-3-4"><input className="pure-u-1" id="contactName" type="text" placeholder="Contact name" value={this.props.contact.contactName} ref="contactName" onChange={this.handleContactNameChange} /></div>
		 <div className="pure-u-1-4"><div className="marleft"><button className="pure-u-1 pure-button pure-button-primary cancel" onClick={this.handleEditCancel} type="button" tabIndex="-1">Cancel / Delete</button></div></div>
		 <div className="clearer"/>
		</div>
		
		<div>
		 
		 <input className="pure-u-5-6" id="phone" type="tel" placeholder="Phone number" ref="phone" value={this.state.contact.phone} onChange={this.handleValueChange}  />
		 <span>
		   <i className="fa fa-phone fa-2x" />
		 </span>
		 <div className="clearer"/>
		</div>
		
		<div>
		 <input className="pure-u-5-6" id="email" type="email" placeholder="Email address" ref="email" value={this.state.contact.email} onChange={this.handleValueChange}/>
		 <span>
		   <i className="fa fa-envelope fa-2x" />
		 </span>
		 <div className="clearer"/>
		</div>
		
		<div>
		 <textarea className="pure-u-5-6" id="address" type="text" placeholder="Address" ref="address" value={this.state.contact.address} onChange={this.handleValueChange}/>
		 <span>
		   <i className="fa fa-home fa-2x" />
		 </span>
		 <div className="clearer"/>
		</div>
		
		<div>
		 <textarea className="pure-u-5-6" id="note" type="text" placeholder="Note" ref="note" value={this.state.contact.note} onChange={this.handleValueChange}/>
		 <span>
		   <i className="fa fa-pencil fa-2x" />
		 </span>
		 <div className="clearer"/>
		</div>
		
		<div className="marleft"><button className="pure-u-1-4 pure-button pure-button-primary submit" type="submit">Submit</button></div>
		<p className="pure-u-3-4 errormsg">{this.state.errorMessage}</p>

	  </fieldset>

      </form>
    );
  }
});

var ContactSearch = React.createClass({
  mixins: [FormMixin],
  handleSubmit: function(e) {
    e.preventDefault();
    var contactName = this.refs.contactName.getDOMNode().value.trim();
	if (contactName.length>0)
    this.props.onContactNameSubmit({contactName: contactName});
    return;
  },
  componentDidMount: function() {
	this.refs.contactName.getDOMNode().focus();
  },
  getInitialState: function() {
    return {errorMessage: this.props.errorMessage};
  },
  render: function() {
  var errorMsg = '' ;
  if (this.state.errorMessage != '')
    errorMsg = <div className="clearer pure-u-3-4 errormsg">{this.state.errorMessage}</div> ;
	
    return (
		<form id="contactSearch" className="pure-form" onSubmit={this.handleSubmit}>
		<fieldset>
	    <div>
		 <div className="pure-u-3-4"><input className="pure-u-1" id="contactName" type="text" placeholder="Contact name" ref="contactName" onChange={this.handleContactNameChange} /></div>
		 <div className="pure-u-1-4"><div className="marleft"><button className="pure-u-1 pure-button pure-button-primary add" type="submit">Add</button></div></div>
		</div>
		{errorMsg}
		</fieldset>
		</form>
    );
  }
});
