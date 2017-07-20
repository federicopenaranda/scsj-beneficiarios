Ext.define('sisscsj.controller.asistenciaactividad.AsistenciaPersonal', {
    extend: 'sisscsj.controller.Base',
    stores: [
        'asistenciaactividad.AsistenciaActividad',
        'asistenciaactividad.AsistenciaBeneficiario',
        'asistenciaactividad.AsistenciaPersonal'
    ],
    views: [
        'asistenciaactividad.BeneficiariosLista',
        'asistenciaactividad.PersonalLista',
        'asistenciaactividad.edit.AsistenciaForm',
        'asistenciaactividad.edit.Form',
        'asistenciaactividad.edit.Window',
        'asistenciaactividad.edit.tab.Asistencia',
        'asistenciaactividad.edit.tab.Beneficiarios',
        'asistenciaactividad.edit.tab.Personal'
    ],
    refs: [
        {
            ref: 'ActividadLista',
            selector: '[xtype=actividad.lista]'
        },
        {
            ref: 'AsistenciaWindow',
            selector: '[xtype=asistenciaactividad.edit.window]'
        },
        {
            ref: 'AsistenciaForm',
            selector: '[xtype=asistenciaactividad.edit.form]'
        },
        {
            ref: 'AsistenciaBeneficiariosLista',
            selector: '[xtype=asistenciaactividad.beneficiarioslista]'
        },
        {
            ref: 'AsistenciaPersonalLista',
            selector: '[xtype=asistenciaactividad.personallista]'
        }
    ],
    init: function() {
        this.listen({
            controller: {},
            component: {
                'grid[xtype=actividad.lista] button#asistencia': {
                    //click: this.add
                },
                'window[xtype=asistenciaactividad.edit.window] button#save': {
                    click: this.save
                },
                'window[xtype=asistenciaactividad.edit.window] button#cancel': {
                    click: this.close
                }
            },
            global: {},
            store: {},
            proxy: {}
        });
    },


    manejaBotones: function ( record, index, eOpts ){
        var me = this;
        var grid = me.getActividadLista();
        var records = grid.getSelectionModel().getSelection();

        var botonEdit = grid.down("[xtype='toolbar'] button#edit");
        var botonDelete = grid.down("[xtype='toolbar'] button#delete");

        if (records.length > 0)
        {
            botonEdit.enable();
            botonDelete.enable();
        }
        else
        {
            botonEdit.disable();
            botonDelete.disable();
        }
    },
    

    loadRecords: function(grid, eOpts) {
        var me = this,
                store = grid.getStore();
        // clear any fliters that have been applied
        store.clearFilter(true);
        // load the store
        store.load();
    },


    edit: function(view, record, item, index, e, eOpts) {
        var me = this;

        var grid = me.getAsistenciaLista();
        var record = grid.getSelectionModel().getSelection()[0];
        // show window
        me.showEditWindow(record);
    },


    add: function(button, e, eOpts) {
        var me = this,
                record = Ext.create('sisscsj.model.asistenciaactividad.AsistenciaActividad');
        // show window
        me.showEditWindow(record);
    },


    save: function(button, e, eOpts) {
        var me = this,
                grid = me.getAsistenciaLista(),
                store = grid.getStore(),
                win = button.up('window'),
                form = win.down('form'),
                record = form.getRecord(),
                values = form.getValues(),
                callbacks;

        if ( form.isValid() )
        {
            
        }
        else
        {
            Ext.Msg.alert('Error de Validación', 'Por favor revise los datos del formulario.');
            return;
        }

        // set values of record from form
        record.set(values);
        
        // check if form is even dirty...if not, just close window and stop everything...nothing to see here
        if (!record.dirty) {
            win.close();
            return;
        }
        // setup generic callback config for create/save methods
        callbacks = {
            success: function(records, operation) {
                store.reload();
                win.close();
            },
            failure: function(records, operation) {
                // if failure, reject changes in store
                store.rejectChanges();
            }
        };
        // mask to prevent extra submits
        Ext.getBody().mask('Guardando Asistencia ...');
        // if new record...
        if (record.phantom) {
            // reject any other changes
            store.rejectChanges();
            // add the new record
            store.add(record);
        }
        // persist the record
        store.sync(callbacks);
    },
            

    close: function(button, e, eOpts) {
        var me = this,
                win = button.up('window');
        // close the window
        win.close();
    },


    showEditWindow: function(record) {
        var me = this,
                win = me.getAsistenciaWindow(),
                isNew = record.phantom;
        // if window exists, show it; otherwise, create new instance
        if (!win) {
            win = Ext.widget('asistenciaactividad.edit.window', {
                title: isNew ? 'Crear Asistencia' : 'Editar Asistencia'
            });
        }
        // show window
        win.show();
        // load form with data
        win.down('form').loadRecord(record);
        win.doComponentLayout();
    },


    cancel: function(editor, context, eOpts) {
        // if the record is a phantom, remove from store and grid
        if (context.record.phantom) {
            context.store.remove(context.record);
        }
    }


});