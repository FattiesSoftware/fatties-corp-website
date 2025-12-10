if (typeof jQuery != "undefined") {
  (function ($) {
    "use strict";
    class HandleAll {
      constructor(controlView) {
        this.controls = $(controlView)
          .get(0)
          .$el.parentsUntil(".elementor-controls-stack");
        this.editor = this.controls.find(".elementor-wp-editor");
        this.currentSession = null;
        this.downloadInProgress = false;
this.downloadCompleted = false;
this.summarizerProgress = 0;
this.languageProgress = 0;
      }

      async getContent() {
        const editorId = this.editor.attr("id");
        if (window.parent.tinyMCE && editorId) {
          const editor = window.parent.tinyMCE.get(editorId);
          if (editor) {
            const content = editor.getContent();
            return content.replace(/<\/?[^>]+(>|$)/g, ""); // Strip HTML tags
          }
        }
      }

      async shortContent(content) {

        const postContent = content;
        try {
          let currentSession = null;
          const summarizer = await Summarizer.create({
            sharedContext: "A blog post",
            type: "headline",
            length: "short",
            format: "plain-text",
          });
          this.currentSession = summarizer;
          currentSession = summarizer;

          const stream = summarizer.summarizeStreaming(postContent, {
            context:
              "Avoid any toxic language and be as constructive as possible.",
          });

          let result = "";

          for await (const value of stream) {
            const newContent = value;
            const cleanedContent = newContent
              .replace(/^#{1,6}\s+/gm, "")
              .replace(/\*\*(.*?)\*\*/g, "$1")
              .replace(/^\s*[-*+]\s/gm, "• ")
              .replace(/[^\w\s.,!?:'\-•\[\]()]/g, "");
            result += cleanedContent;
            const footer = document.querySelector(".swal2-footer");
            if (footer) {
              footer.style.display = "none";
            }
            Swal.update({
              html: `<textarea class="result-content" disabled>${result}</textarea>`,
              footer: null,
              showCloseButton: true,
              didClose: () => {
                if (currentSession) {
                  currentSession.destroy();
                  currentSession = null;
                }
              },
            });
            const textarea = document.querySelector(".result-content");
            if (textarea) {
              textarea.scrollTop = textarea.scrollHeight;
            }
            Swal.showLoading();
          }

          return result;
        } catch (error) {
throw error;
        }
      }

      async writeContent(inputText, contextInfo = "", additionalText = "") {
        try {

          let currentSession = null;
          const session = await LanguageModel.create();
          this.currentSession = session;

          let context = `
            Avoid any toxic language and be as constructive as possible.
          `;

          if (contextInfo) {
            context += `\n${contextInfo}`;
          }

          const stream = session.promptStreaming(
            `
            You are an AI writing assistant. Your goal is to help users with writing tasks by generating relevant and high-quality text. Do NOT answer questions; simply write on behalf of the user. Use the provided "input" (writing task) and "context" (extra information) to tailor your response. Focus on producing error-free and engaging writing. Do not explain your response, just provide the generated text please dont add any formatting or styling.
      
            Input: ${inputText}
            Context: ${context}
            `
          );

          let result = "";
          let previousChunk = "";

          for await (const chunk of stream) {
            const newContent = chunk;
            const cleanedContent = newContent
              .replace(/[^\w\s.,!?:\[\]()\-]/g, "")
              .replace(/[#*]/g, "");
            result += cleanedContent;
            previousChunk = chunk;

            const footer = document.querySelector(".swal2-footer");
            if (footer) {
              footer.style.display = "none";
            }

            Swal.update({
              html: `<textarea class="result-content" disabled>${result}</textarea>`,
              footer: null,
              showCloseButton: true,
              didClose: () => {
                if (currentSession) {
                  currentSession.destroy();
                  currentSession = null;
                }
              },
            });

            const textarea = document.querySelector(".result-content");
            if (textarea) {
              textarea.scrollTop = textarea.scrollHeight;
            }
            Swal.showLoading();
          }

          return result;
        } catch (error) {
          throw error;
        }
      }

      async summarizeContent(content) {

        
        const postContent = content;
        try {
          
      
          // destroy previous session if exists
          if (this.currentSession) {
           
            try {
              
              this.currentSession.destroy();
            } catch (err) {}
            this.currentSession = null;
          }
          
          
          const summarizer = await Summarizer.create({
            sharedContext: "A blog post",
            type: "teaser",
            length: "medium",
            format: "plain-text",
          });
          this.currentSession = summarizer;

          
      
          // Create SweetAlert popup only once
          Swal.fire({
            title: "Summarizing...",
            html: `<textarea class="result-content" disabled style="width:100%;height:200px;"></textarea>`,
            showCloseButton: true,
            didClose: () => {
              if (this.currentSession) {
                this.currentSession.destroy();
                this.currentSession = null;
              }
            },
            didOpen: () => {
              Swal.showLoading();
            }
          });
      
          const stream = summarizer.summarizeStreaming(postContent, {
            context: "Avoid any toxic language and be as constructive as possible.",
          });
      
          let result = "";
          for await (const value of stream) {
            const cleanedContent = value
              .replace(/^#{1,6}\s+/gm, "")
              .replace(/\*\*(.*?)\*\*/g, "$1")
              .replace(/^\s*[-*+]\s/gm, "• ")
              .replace(/[^\w\s.,!?:'\-•\[\]()]/g, "");
      
            result += cleanedContent;
      
            const textarea = document.querySelector(".result-content");
            if (textarea) {
              textarea.value = result;
              textarea.scrollTop = textarea.scrollHeight;
            }
          }
      
          Swal.hideLoading();
          return result;
      
        } catch (error) {
          console.error("Summarizer Error:", error);
          Swal.fire("Error", error.message || "Failed to summarize content.", "error");
        }
      }
      

      async generateAIContent(chipText, text) {



        let currentSession = null;


        const session = await LanguageModel.create({
          systemPrompt: `Act as a professional content writer. Generate engaging, informative, and clear content without using markdown formatting of any kind like: * and #. Use bold text sparingly for headings, emphasis, or key points to enhance readability and highlight important information. For lists, use simple text-based formatting, such as:
         - Bulleted points with hyphens or bullets
          - Numbered lists with standard numbering
           Ensure all content is free of special markdown syntax. Maintain a conversational, approachable tone.`,
        });
        this.currentSession = session;


        try {

          const prompt = `${text} ${chipText}`;



          const response = await session.promptStreaming(prompt);
          let result = "";
          if (text === "Continue the text exactly from where it ends, preserving its tone and style. Do not remove or alter any existing content.here is text: ") {
            const previousResult = document.querySelector('.ai-prompt-input');
            result = result + previousResult.textContent + "\n";
          }
          let previousChunk = "";

          for await (const chunk of response) {
            const newContent = chunk;

            const cleanedContent = newContent
              .replace(/^#{1,6}\s+/gm, "")

              .replace(/\*\*(.*?)\*\*/g, "$1")

              .replace(/^\s*[-*+]\s/gm, "• ")

              .replace(/[^\w\s.,!?:'\-•\[\]()]/g, "");

            result += cleanedContent;

            const footer = document.querySelector(".swal2-footer");
            if (footer) {
              footer.style.display = "none";
            }

            Swal.update({
              html: `<textarea class="result-content" disabled>${result}</textarea>`,
              footer: null,
              showCloseButton: true,
              didClose: () => {
                if (currentSession) {
                  currentSession.destroy();
                  currentSession = null;
                }
              },
            });


            const textarea = document.querySelector(".result-content");
            if (textarea) {
              textarea.scrollTop = textarea.scrollHeight;
            }
            Swal.showLoading();
          }
          return result;
        } catch (error) {
throw error;
        }
      }

      getPromptData() {
        return {
          paragraph: {
            menuTitle: "Write a paragraph on this",
            prompt:
              "Write a well-structured paragraph on the following topic, maintaining clarity and coherence here is the topic:",
          },
          continue: {
            menuTitle: "Continue this text",
            prompt:
              "Continue the text exactly from where it ends, preserving its tone and style. Do not remove or alter any existing content.here is text: ",
          },
          ideas: {
            menuTitle: "Generate ideas on this",
            prompt: "Generated ideas on this topic:",
          },
          article: {
            menuTitle: "Write an article about this",
            prompt: "Write a complete article about this:",
          },
          tldr: {
            menuTitle: "Generate a TL;DR",
            prompt: "Generate a TL;DR of this text:",
          },
        };
      }
      checkBrowser() {
        if (!window.hasOwnProperty("chrome") || !navigator.userAgent.includes("Chrome") || navigator.userAgent.includes("Edg")) {
          Swal.fire({
            title: "Chrome Browser Required",
            html: `<div class="ai_text_model_error">
              <p>This feature is exclusively supported on the Google Chrome browser.</p>
            </div>`,
            showCloseButton: true,
            showConfirmButton: false,
            width: 400,
            customClass: {
              container: "aacgfe-modal-main-wrp",
            },
          });
          return false;
        }
        return true;
      }

      checkChromeVersion(minVersion = 138) {
        const raw = navigator.userAgent.match(/Chrom(e|ium)\/([0-9]+)\./);
        const version = raw ? parseInt(raw[2], 10) : null;

        if (!version || version < minVersion) {
          Swal.fire({
            title: "Chrome Update Required",
            html: `<div class="ai_text_model_error">
              <p>Please update your Chrome browser to version ${minVersion} or later to use this feature.</p>
            </div>`,
            showCloseButton: true,
            showConfirmButton: false,
            width: 400,
            customClass: {
              container: "aacgfe-modal-main-wrp",
              title: "aacgfe-modal-title",
            },
          });
          return false;
        }
        return true;
      }

      checkSecureContext() {
        if (!window.isSecureContext) {
          Swal.fire({
            title: "⚠ Your connection is not secure!",
            html: `<div class="ai_text_model_error secure_check">
                <p>To secure your connection, follow these steps:</p>
                <ol>
                    <li>Open a new tab and go to: <b>chrome://flags/#unsafely-treat-insecure-origin-as-secure</b></li>
                    <li>Enable the flag and add paste your site URL.</li>
                    <li>Then relaunch your browser.</li>
                </ol>
            </div>`,
            showCloseButton: true,
            showConfirmButton: false,
            width: 600,
            customClass: {
              container: "aacgfe-modal-main-wrp secure_tab_notice",
              title: "aacgfe-modal-title",
            },
          });
          return false;
        }
        return true;
      }

      async showAIContentGeneratorModal() {


        const content = await this.getContent();
        if (!content || content.trim() === "") {
          Swal.fire({
            html: `<div class="ai_text_model_error_content"><p>Please enter some content first</p></div>`,
            showCloseButton: true,
            showConfirmButton: false,
          });
          return;
        }

        const promptData = this.getPromptData();

        const resultContent = document.querySelector(".result-content");

        if (resultContent) {
          resultContent.value = "";
        }

        const promptOptions = Object.entries(promptData)
          .map(
            ([key, value]) => `
            <option value="${key}">${value.menuTitle}</option>
          `
          )
          .join("");
        Swal.fire({
          title: "AI Content Generator",
          html: `<div><p>Generate Content in Few Seconds With Chrome Built-in AI. </p></div>
            <div class="ai-content-generator">
              <div class="input-wrapper">
                <textarea class="ai-prompt-input" disabled>${content}</textarea>
              </div>
              <div class="suggested-prompts">
                <h6>Suggested Prompts</h6>
                <div class="prompt-chips">
                  <button class="prompt-chip">Make it a headline</button>
                  <button class="prompt-chip">Make it longer</button>
                  <button class="prompt-chip">Fix the grammar</button>
                  <button class="prompt-chip">Write on this topic</button>
                  <button class="prompt-chip">Summarize this</button>
                   <select id="custom-prompts" class="custom-prompt-select">
                    <option value="" disabled selected>Select a prompt</option>
                    ${promptOptions}
                  </select>
                </div>
              
              </div>
            </div>`,
          footer: `<div class="result-actions">
            <button class="regenerate-btn" id="ai_regenrate_button">Generate Text</button>
          </div>`,
          showCloseButton: true,

          customClass: {
            container: "aacgfe-modal-main-wrp",
            loader: "loading",
          },

          showConfirmButton: false,
          width: 600,
          didOpen: () => {
            const input = document.querySelector(".ai-prompt-input");
            const modal = document.querySelector(".swal2-container");
            const customPromptSelect =
              document.querySelector("#custom-prompts");


            modal.addEventListener("mousedown", (e) => e.stopPropagation());
            modal.addEventListener("mouseup", (e) => e.stopPropagation());
            modal.addEventListener("click", (e) => e.stopPropagation());
            modal.addEventListener("focus", (e) => e.stopPropagation(), true);

            let promptText = "";


            document.querySelectorAll(".prompt-chip").forEach((chip) => {
              chip.addEventListener("click", () => {

                document.querySelectorAll(".prompt-chip").forEach((c) => {
                  c.classList.remove("active");
                });

                chip.classList.add("active");


                customPromptSelect.value = "";

                promptText = chip.textContent;

                return promptText;
              });
            });

            // Handle custom prompt selection
            customPromptSelect.addEventListener("change", (e) => {
              // Remove active class from all chips when dropdown is selected
              document.querySelectorAll(".prompt-chip").forEach((chip) => {
                chip.classList.remove("active");
              });
              const selectedPrompt = promptData[e.target.value];
              if (selectedPrompt) {
                promptText = selectedPrompt.prompt.replace("[[text]]", content);
              }
            });


            // Handle generate content
            const generateContent = async () => {


              const promptddText = promptText;

              if (!promptText) return;



              // Hide prompt chips and dropdown instead of just disabling
              document.querySelector(".suggested-prompts").style.display =
                "none";

              Swal.showLoading();
              document.querySelector("#ai_regenrate_button").style.display =
                "none";
              document
                .querySelector(".swal2-container")
                .classList.add("loading");

              let result;
              if (promptddText === "Summarize this") {
                try {

                  result = await this.summarizeContent(content);
                } catch (error) {

                }
              } else if (promptddText === "Make it shorter") {
                try {

                  result = await this.shortContent(content);
                } catch (error) {

                }
              } else if (promptddText === "Write on this topic") {
                try {

                  result = await this.writeContent(content);
                } catch (error) {

                }
              } else if (promptddText === "Fix the grammar") {
                try {

                  result = await this.generateAIContent(content, "Fix the grammar of the following text. Only return the corrected statements without any explanations or additional text.");
                } catch (error) {
                }
              } else {
                try {

                  result = await this.generateAIContent(content, promptText);

                } catch (error) {

                }
              }

              if (result) {
                Swal.fire({
                  title: "AI Content Generator",
                  width: 600,
                  html: `<textarea class="result-content" disabled>${result}</textarea>`,
                  showConfirmButton: false,
                  footer: `<div class="ai_footer_main_div">
                    <button class="regenerate-btn" id="ai_new_promt_button">New Prompt</button>
                    <button class="regenerate-btn" id="ai_use_text_button">Use Text</button>
                  </div>`,
                  showCloseButton: true,
                  customClass: {
                    container: "aacgfe-modal-main-wrp",
                    loader: "loading",
                  },
                });

                // Updated "Use Text" button click handler
                document
                  .getElementById("ai_use_text_button")
                  .addEventListener("click", () => {
                    try {
                      const content = result.trim().replace(/\r?\n/g, "<br />");
                      if (window.parent.tinyMCE) {
                        const editorId = this.editor.attr("id");
                        const activeEditor =
                          window.parent.tinyMCE.get(editorId);
                        if (activeEditor) {
                          activeEditor.setContent(content);
                          activeEditor.fire("change");
                        }
                      } else {
                        this.editor.val(content);
                        this.editor.trigger("change");
                      }
                      Swal.close();
                    } catch (error) {
                      this.editor.val(result.trim());
                      this.editor.trigger("change");
                      Swal.close();
                    }
                  });

                // Handle "New Prompt" button click
                document
                  .getElementById("ai_new_promt_button")
                  .addEventListener("click", (ele) => {
                    ele.stopPropagation();
                    this.genearteContentHandler();
                  });
              }
            };

            // Add enter key handler
            input.addEventListener("keypress", (e) => {
              if (e.key === "Enter") {
                generateContent();
              }
            });

            // Add regenerate button handler
            document
              .querySelector(".regenerate-btn")
              .addEventListener("click", generateContent);
          },
          willClose: () => {
            var closebtn = document.querySelectorAll(".swal2-close");


            if (this.currentSession) {

              try {

                this.currentSession.destroy();
                this.currentSession = null;
              } catch (error) {

              }
            }
          },
        });
      }

      async genearteContentHandler() {


        if (!this.checkBrowser()) return;
        if (!this.checkChromeVersion(138)) return;
        if (!this.checkSecureContext()) return;

        let availabilityRefernce = null;
        if (typeof Summarizer !== "undefined") {
          availabilityRefernce = await Summarizer.availability();
        }
        let languageReference = null;
        if (typeof LanguageModel !== "undefined") {
          languageReference = await LanguageModel.availability()
        }
        if (availabilityRefernce === null || languageReference === null) {
          Swal.fire({
            title: "AI Model Unavailable",
            html: `<div class="ai_text_model_error"><p><b> Warning! Ensure the AI model is installed in your browser by referring to the official  <a href="https://developer.chrome.com/docs/ai/built-in-apis" target="_blank" rel="noopener noreferrer">Chrome AI Model documentation</a>. Then, enable these flags:</b>
          <ol>
            <li>Please update your Chrome browser to version 138 or later.</li>
            <li>Copy this flag and paste it in your chrome browser search bar</li>
            <li><code class="aacgfe-code-block">chrome://flags/#optimization-guide-on-device-model</code> – Enabled BypassPerfRequirement this flag.</li>
            <li><code class="aacgfe-code-block">chrome://flags/#prompt-api-for-gemini-nano</code> - Enable this flag.</li>
            <li><code class="aacgfe-code-block">chrome://flags/#summarization-api-for-gemini-nano</code> – Enable this flag.</li>
            <li>Then relaunch your browser</li>
          </ol>
          <p><b>For more details, check the official <a href="https://coolplugins.net/ai-content-generator-for-elementor/?utm_source=acge_plugin&utm_medium=inside&utm_campaign=blog&utm_content=panel_popup" target="_blank">documentation</a></b></p>
          </div>`,
            showCloseButton: true,
            showConfirmButton: false,
            width: 600,
            customClass: {
              container: "aacgfe-modal-main-wrp",
            },
            didOpen: () => {
              document
                .querySelector(".swal2-html-container")
                .addEventListener("click", function (event) {
                  let link = event.target.closest("a");
                  if (link) {
                    event.preventDefault();
                    window.open(link.href, "_blank");
                  }
                });
            },
          });
          return;
        } else if(availabilityRefernce === 'unavailable' || languageReference === 'unavailable'){
          Swal.fire({
            title: "AI Model Unavailable",
            html: `<div class="ai_text_model_error"><p><b> Warning! Ensure the AI model is installed in your browser by referring to the official  <a href="https://developer.chrome.com/docs/ai/built-in-apis" target="_blank" rel="noopener noreferrer">Chrome AI Model documentation</a>. Then, enable these flags:</b>
          <ol>
            <li>Copy this flag and paste it in your chrome browser search bar</li>
            <li><code class="aacgfe-code-block">chrome://flags/#optimization-guide-on-device-model</code> – Enabled BypassPerfRequirement this flag.</li>
            <li>Then relaunch your browser</li>
          </ol>
          <p><b>Note:</b> If you enable this flag and it still does not work, the user's device or requested session options are not supported. 
      The device may have insufficient power or disk space.</p>
          <p><b>For more details, check the official <a href="https://coolplugins.net/ai-content-generator-for-elementor/?utm_source=acge_plugin&utm_medium=inside&utm_campaign=blog&utm_content=panel_popup" target="_blank">documentation</a></b></p>
          </div>`,
            showCloseButton: true,
            showConfirmButton: false,
            width: 600,
            customClass: {
              container: "aacgfe-modal-main-wrp",
            },
          });
        }
        
        else if (availabilityRefernce == 'downloadable' || languageReference == 'downloadable') {
          // 👇 Agar already complete nahi hua
          if (!this.downloadCompleted) {
            Swal.fire({
              title: "AI Model Downloading",
              html: `
                <div class="download_container">
                  <div class="notice_download_model">
                    <p><b>Please wait, the AI model is downloading... Don't leave the window.</b></p>
                  </div> 
                  <div class="model_download_div"><h4>📝 Summarizer</h4></div>
                  <div class="progress-container">
                    <div class="progress-bar-bg">
                      <div class="aacfe_progress_div" style="width:${Math.max(this.summarizerProgress || 0, 0)}%;" id="summarizer_progress">${Math.max(this.summarizerProgress || 0, 0)}%</div>
                    </div>
                  </div>
                  <div class="model_download_div"><h4>🤖 Language Model</h4></div>
                  <div class="progress-container">
                    <div class="progress-bar-bg">
                      <div class="aacfe_progress_div" style="width:${Math.max(this.languageProgress || 0, 0)}%;" id="language_model_progress">${Math.max(this.languageProgress || 0, 0)}%</div>
                    </div>
                  </div>
                </div>
              `,
              showCloseButton: true,
              showConfirmButton: false,
              width: 600,
              customClass: {
                container: "aacgfe-modal-main-wrp",
              },
              didOpen: async () => {
                // Initialize progress if not already set
                if (this.summarizerProgress === undefined || this.summarizerProgress === null) {
                  this.summarizerProgress = 0;
                }
                if (this.languageProgress === undefined || this.languageProgress === null) {
                  this.languageProgress = 0;
                }
                
                let summarizerDone = (this.summarizerProgress >= 100);
                let languageDone = (this.languageProgress >= 100);
                this.downloadInProgress = true;
                this.downloadCompleted = false;
                
                
        
                const checkCompletion = () => {
                  if (summarizerDone && languageDone) {
                    this.downloadInProgress = false;
                    this.downloadCompleted = true;
                    const container = document.querySelector(".download_container");
                    if (container) {
                      container.innerHTML = `
                        <div class="notice_download_model">
                          <p>✅ All models downloaded successfully!</p>
                        </div>
                        <div class="model_download_div"><h4> 📝 Summarizer</h4></div>
                        <div class="progress-container">
                          <div class="aacfe_progress_div" style="width:100%;">100%</div>
                        </div>
                        <div class="model_download_div"><h4> 🤖 Language Model</h4></div>
                        <div class="progress-container">
                          <div class="aacfe_progress_div" style="width:100%;">100%</div>
                        </div>
                        <button id="continueBtn" class="aafe_continue_button" style="display:inline-block;">Continue</button>
                      `;
                      document.getElementById("continueBtn").addEventListener("click", () => {
                        this.showAIContentGeneratorModal();
                      });
                    }
                  }
                };
        
                // Download models simultaneously but handle progress separately
                const downloadPromises = [];

                // Summarizer
                if (!summarizerDone) {
                  const summarizerPromise = (async () => {
                    try {
                      await Summarizer.create({
                        monitor: (m) => {
                          m.ondownloadprogress = (e) => {
                            
                            let fraction = 0;
                            if (typeof e.total === "number" && e.total > 0) {
                              fraction = e.loaded / e.total;
                            } else if (typeof e.loaded === "number") {
                              // Fallback: treat loaded as a percentage (0-1 range)
                              fraction = Math.min(e.loaded, 1);
                            }
                            const percent = Math.round(Math.max(0, Math.min(1, fraction)) * 100);
                            this.summarizerProgress = percent;
                            
                            const elem = document.getElementById("summarizer_progress");
                            if (elem) {
                              elem.style.width = percent + "%";
                              elem.textContent = percent + "%";
                            }
                            
                            if (percent >= 100) {
                              summarizerDone = true;
                              checkCompletion();
                            }
                          };
                        },
                      });
                    } catch (err) {
                      console.error("Summarizer download failed:", err);
                      summarizerDone = true; // Mark as done even if failed
                      checkCompletion();
                    }
                  })();
                  downloadPromises.push(summarizerPromise);
                }
        
                // Language Model
                if (!languageDone) {
                  const languagePromise = (async () => {
                    try {
                      await LanguageModel.create({
                        monitor: (m) => {
                          m.ondownloadprogress = (e) => {
                            
                            let fraction = 0;
                            if (typeof e.total === "number" && e.total > 0) {
                              fraction = e.loaded / e.total;
                            } else if (typeof e.loaded === "number") {
                              // Fallback: treat loaded as a percentage (0-1 range)
                              fraction = Math.min(e.loaded, 1);
                            }
                            const percent = Math.round(Math.max(0, Math.min(1, fraction)) * 100);
                            this.languageProgress = percent;
                            
                            const elem = document.getElementById("language_model_progress");
                            if (elem) {
                              elem.style.width = percent + "%";
                              elem.textContent = percent + "%";
                            }
                            
                            if (percent >= 100) {
                              languageDone = true;
                              checkCompletion();
                            }
                          };
                        },
                      });
                    } catch (err) {
                      console.error("Language model download failed:", err);
                      languageDone = true; // Mark as done even if failed
                      checkCompletion();
                    }
                  })();
                  downloadPromises.push(languagePromise);
                }

                // Start all downloads
                Promise.all(downloadPromises).then(() => {
                 
                }).catch((err) => {
                  console.error("Download error:", err);
                });
              },
              didClose: () => {
                // If user closed before completion, keep things idle and do NOT auto-open the next modal
                if (!this.downloadCompleted) {
                  this.downloadInProgress = false;
                  return;
                }
                if (this.currentSession && this.downloadCompleted) {
                  try {
                    this.currentSession.destroy();
                    this.currentSession = null;
                  } catch (error) {
                    console.error("Error destroying session:", error);
                  }
                }
              },
            });
            return;
          } else {
            // agar pehle hi download complete ho chuka hai
            this.showAIContentGeneratorModal();
          }
        }else{
          
          // Only open content modal if no download is in progress or it's completed
          if (this.downloadInProgress && !this.downloadCompleted) {
            return;
            
          }
          this.showAIContentGeneratorModal();
        }
      }
    }

    $(window).on("elementor/frontend/init", function () {
      elementor.channels.editor.on(
        "ai:content:generate",
        function (controlView) {
          const obj = new HandleAll(controlView);
          obj.genearteContentHandler();
        }
      );
    });
  })(jQuery);
  }