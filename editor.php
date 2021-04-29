<!DOCTYPE html>
<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.16.45/grapes.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/grapesjs/0.16.45/css/grapes.min.css">
        <script src="./grapesjs-blocks-basic.min.js"></script>
        <link href="./grapesjs-preset-webpage.min.css" rel="stylesheet"/>
        <script src="./grapesjs-preset-webpage.min.js"></script>
    </head>
    <body>
      <!-- <div class="panel__top">
        <div class="panel__basic-actions"></div>
        <div class="panel__switcher"></div>
      </div>     -->
      <div class="editor-row">
        <div class="editor-canvas">
          <div id="gjs"></div>
        </div>
        

        <!-- <div class="panel__right">
          <div class="layers-container"></div>
        <div class="styles-container"></div>
        </div> -->
      </div>
      <!-- <div id="blocks">

      </div> -->
          
          
          
      <script>
          const editor = grapesjs.init({
            // Indicate where to init the editor. You can also pass an HTMLElement
            container: '#gjs',
            // Get the content for the canvas directly from the element
            // As an alternative we could use: `components: '<h1>Hello World Component!</h1>'`,
            
              plugins: ["gjs-blocks-basic",'gjs-preset-webpage'],
              pluginsOpts: {
                "gjs-blocks-basic": {
                  /* ...options */
                  blocks: ['column1', 'column2', 'column3', 'column3-7', 'text', 'image','map']
                },
                'gjs-preset-webpage': {
          // options
          blocks: [],
          modalImportButton: "",
          textCleanCanvas: "Do you really want to clear canvas and start from scratch? ",
          importViewerOptions: false,
          blocksBasicOpts: false,
          navbarOpts:false,
          countdownOpts:false,
          formsOpts:false,
          exportOpts:false
        }
              },
              style: '.txt-red{color: red}',
                fromElement: true,
                // Size of the editor
                //height: '300px',
               
                width: 'auto',

                storageManager: {
                  type: 'remote',
                  stepsBeforeSave: 1,
                  autosave: true,         // Store data automatically
                  autoload: true,
                  urlStore: './store.php',
                  <?php
                  include_once('db.php');
                  global $conn;
                  $sql = "SELECT * FROM `data_raw` ";
                  $statement = $conn->prepare($sql);
                  $statement->execute();
                  $data = $statement->get_result()->num_rows;
              
                  $position = $data+1;

                  $sql = "INSERT INTO `data_raw` (`data`,`html`,`components`,`assets`,`css`,`styles`) VALUES (?,?,?,?,?,?)  ";
                  $statement= $conn->prepare($sql);
                  $empty = "";
                  $statement->bind_param('ssssss',$empty,$empty,$empty,$empty,$empty,$empty);
                  $statement->execute();
                  if (isset($_REQUEST['ref'])){
                   echo " urlLoad: '\./load.php?id=".$_REQUEST['ref']."',
                    params: { id: ".$_REQUEST['ref']." },";
                  }elseif(isset($_REQUEST['base'])){
                    echo " urlLoad: '\./load.php?base=".$_REQUEST['base']."',
                    params: {  id: ".$position."  },";
                  }
                  else{
                    echo " urlLoad: '\./load.php?id=".$position."',
                    params: {  id: ".$position."  },";
                  }
                  ?>
                  
                  contentTypeJson: true,
                  storeComponents: true,
                  storeStyles: true,
                  storeHtml: true,
                  storeCss: true,
                  headers: {
                    'Content-Type': 'application/json'
                  }
                },
                // layerManager: {
                //   appendTo: '.layers-container'
                // },
                  
                  // panels: {
                  //   defaults: [{
                  //     id: 'layers',
                  //     el: '.panel__right',
                  //     // Make the panel resizable
                  //     resizable: {
                  //       maxDim: 350,
                  //       minDim: 200,
                  //       tc: 0, // Top handler
                  //       cl: 1, // Left handler
                  //       cr: 0, // Right handler
                  //       bc: 0, // Bottom handler
                  //       // Being a flex child we need to change `flex-basis` property
                  //       // instead of the `width` (default)
                  //       keyWidth: 'flex-basis',
                  //     },
                  //   },
                  //   {
                  //   id: 'panel-switcher',
                  //   el: '.panel__switcher',
                  //   buttons: [{
                  //       id: 'show-layers',
                  //       active: true,
                  //       label: 'Layers',
                  //       command: 'show-layers',
                  //       // Once activated disable the possibility to turn it off
                  //       togglable: false,
                  //     }, {
                  //       id: 'show-style',
                  //       active: true,
                  //       label: 'Styles',
                  //       command: 'show-styles',
                  //       togglable: false,
                  //   },
                    
                  
                  //   ]},
                  // ]
                  // },
    //               selectorManager: {
    //   appendTo: '.styles-container'
    // },
    // styleManager: {
    //   appendTo: '.styles-container',
    //   sectors: [{
    //       name: 'Dimension',
    //       open: false,
    //       // Use built-in properties
    //       buildProps: ['width', 'min-height', 'padding'],
    //       // Use `properties` to define/override single property
    //       properties: [
    //         {
    //           // Type of the input,
    //           // options: integer | radio | select | color | slider | file | composite | stack
    //           type: 'integer',
    //           name: 'The width', // Label for the property
    //           property: 'width', // CSS property (if buildProps contains it will be extended)
    //           units: ['px', '%'], // Units, available only for 'integer' types
    //           defaults: 'auto', // Default value
    //           min: 0, // Min value, available only for 'integer' types
    //         }
    //       ]
    //     },{
    //       name: 'Extra',
    //       open: false,
    //       buildProps: ['background-color', 'box-shadow', 'custom-prop'],
    //       properties: [
    //         {
    //           id: 'custom-prop',
    //           name: 'Custom Label',
    //           property: 'font-size',
    //           type: 'select',
    //           defaults: '32px',
    //           // List of options, available only for 'select' and 'radio'  types
    //           options: [
    //             { value: '12px', name: 'Tiny' },
    //             { value: '18px', name: 'Medium' },
    //             { value: '32px', name: 'Big' },
    //           ],
    //       }
    //       ]
    //     }]
    // },

    //               blockManager: {
    //   appendTo: '#blocks',
    //   blocks: [
        
    //     {
    //       id: 'section', // id is mandatory
    //       label: '<b>Section</b>', // You can use HTML/SVG inside labels
    //       attributes: { class:'gjs-block-section' },
    //       content: `<section>
    //         <h1>This is a simple title</h1>
    //         <div>This is just a Lorem text: Lorem ipsum dolor sit amet</div>
    //       </section>`,
    //     },
    //     {
    //       id: 'Two Columns', // id is mandatory
    //       label: '<b>2 columns</b>', // You can use HTML/SVG inside labels
    //       attributes: { class:'gjs-block-section' },
    //       content: `<div class="row" data-gjs-droppable=".row-cell" data-gjs-custom-name="Row">
    //     <div class="row-cell" data-gjs-draggable=".row"></div>
    //     <div class="row-cell" data-gjs-draggable=".row"></div>
    //   </div>`,
    //     },
    //     {
    //       id: 'text',
    //       label: 'Texty test',
    //       content: '<div data-gjs-type="text">Insert your text here</div>',
    //     }, {
    //       id: 'image',
    //       label: 'Image',
    //       // Select the component once it's dropped
    //       select: true,
    //       // You can pass components as a JSON instead of a simple HTML string,
    //       // in this case we also use a defined component type `image`
    //       content: { type: 'image' },
    //       // This triggers `active` event on dropped components and the `image`
    //       // reacts by opening the AssetManager
    //       activate: true,
    //     }
    //   ]
    // },
              }

              );
  //             editor.Panels.addPanel({
  //   id: 'panel-top',
  //   el: '.panel__top',
  // });
  editor.Panels.addPanel({
    id: 'basic-actions',
    el: '.panel__basic-actions',
    buttons: [
      {
        id: 'visibility',
        active: true, // active by default
        className: 'btn-toggle-borders',
        label: '<u>B</u>',
        command: 'sw-visibility', // Built-in command
      }, {
        id: 'export',
        className: 'btn-open-export',
        label: 'Exp',
        command: 'export-template',
        context: 'export-template', // For grouping context of buttons from the same panel
      }, {
        id: 'show-json',
        className: 'btn-show-json',
        label: 'JSON',
        context: 'show-json',
        command(editor) {
          editor.Modal.setTitle('Components JSON')
            .setContent(`<textarea style="width:100%; height: 250px;">
              ${JSON.stringify(editor.getComponents())}
            </textarea>`)
            .open();
        },
      }
    ],
  });
  editor.on('run:export-template:before', opts => {
    console.log('Before the command run');
    if (0 /* some condition */) {
      opts.abort = 1;
    }
  });
  editor.on('run:export-template', () => console.log('After the command run'));
  editor.on('abort:export-template', () => console.log('Command aborted'));
  // Define commands
  editor.Commands.add('show-layers', {
    getRowEl(editor) { return editor.getContainer().closest('.editor-row'); },
    getLayersEl(row) { return row.querySelector('.layers-container') },

    run(editor, sender) {
      const lmEl = this.getLayersEl(this.getRowEl(editor));
      lmEl.style.display = '';
    },
    stop(editor, sender) {
      const lmEl = this.getLayersEl(this.getRowEl(editor));
      lmEl.style.display = 'none';
    },
  });
  editor.Commands.add('show-styles', {
    getRowEl(editor) { return editor.getContainer().closest('.editor-row'); },
    getStyleEl(row) { return row.querySelector('.styles-container') },

    run(editor, sender) {
      const smEl = this.getStyleEl(this.getRowEl(editor));
      smEl.style.display = '';
    },
    stop(editor, sender) {
      const smEl = this.getStyleEl(this.getRowEl(editor));
      smEl.style.display = 'none';
    },
  });

  
  var blockManager = editor.BlockManager;

  // 'my-first-block' is the ID of the block
  blockManager.add('my-first-block', {
    label: 'Simple block',
    content: '<div class="my-block">This is a simple block</div>',
  });
  blockManager.add('my-second-block', {
    label: '<b>Header</b>',
    content: `<div>
    <div >
      <img src="" width="258" height="169" alt=""/></div>
    <div>
    <p>  Organisation Name </p>
    <p> About Organisation </p>
    <p> Address </p>
    <p>Telephone|Email</p>
    </div>
  </div>`,});
  blockManager.add('my-2column-block', {
    label: 'Two column block',
    content: `
<div style="float: left; width:50%; margin-bottom: 0pt;  ">
<div>
<p>Column 1</p>
</div>
</div>
<div style="float: right; width: 50%; margin-bottom: 0pt;  ">
<div>
<p>Column 2</p>
</div>
</div>
<div style="clear:both;"> </div>
`,
  });

  var component = blockManager.add('my-footer-block', {
    label: 'Footer block',
    content: `
<div style="float: left; width:50%; margin-bottom: 0pt;  ">
<div><h1>[name]<br/> </h1>
<p><b>[role]</b><br/></p>
<b>[businessname] </b> 
</div>
</div>
<div style="float: right; width: 50%; margin-bottom: 0pt;  ">
[buyer] <br/>
	<p><b>[customer]</b></p>
</div>
<div style="clear:both;"> </div>
`,
  });

  blockManager.add('green-full-header', {
    label: 'Green full header',
    content: `<div >
  <div style="float: left; width:25%; margin-bottom: 0pt;  "><img src="" width="258" height="169" alt=""/></div>
  <div style="float: right; width: 70%; margin-bottom: 0pt;  ">
  <h1>  [businessname] </h1>
  <p> [about]</p>
  <p> [address]</p>
  <p>[telephone]: [phone]|[emailhead]: [email]</p>
  </div>
</div>
<hr/>
<div style="clear:both;background:#AAD76B;height:30pt; width:100%;"></div>
<div class="customer" style="clear:both;"><h3>[customerdetails]</h3> <hr/>
<p>[buyer]<br/>
[billstreet]<br/>
[billphone]</p>
</div>
<div style="clear:both;font-size:1em; text-align: center;"><h2>[receipt]</h2>

<hr/></div>
<div style=" float: left; width: 50%; margin-bottom: 0pt; ">
<b>[receiptno]: </b>[recnumber] <br/> <b>Date Issued: </b>[date] <br/> 
</div>
<div style="clear:both;"> </div>`,
  });
  
 
 



          </script>
          <style>
                #gjs {
    border: none;
  }
  /* Theming */

  /* Primary color for the background */
  .gjs-one-bg {
    background-color: #78366a;
  }

  /* Secondary color for the text color */
  .gjs-two-color {
    color: rgba(255, 255, 255, 0.7);
  }

  /* Tertiary color for the background */
  .gjs-three-bg {
    background-color: #ec5896;
    color: white;
  }

  /* Quaternary color for the text color */
  .gjs-four-color,
  .gjs-four-color-h:hover {
    color: #ec5896;
  }
          </style>
  </body>
</html>